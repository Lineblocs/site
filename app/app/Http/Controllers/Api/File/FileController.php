<?php

namespace App\Http\Controllers\Api\File;
use \App\Http\Controllers\Api\ApiAuthController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\File;
use \App\ApiCredentialKVStore;
use \App\CustomizationsKVStore;

use \App\Transformers\FileTransformer;
use \DB;
use App\Helpers\MainHelper;



class FileController extends ApiAuthController {
     public static $acceptedFileFormats = array("mp3", "wav", "mpga");
      public static $maxFileSizeBytes = 10000000;
      public static $maxFileSizeReadable = "10MB";
      public function listFiles(Request $request)
    {
        $paginate = $this->getPaginate( $request );
        $user = $this->getUser($request);
        \Log::info('getting files for user ' . $user->id);
        $workspace = $this->getWorkspace($request);
        $files = File::where('workspace_id', $workspace->id);
        MainHelper::addSearch($request, $files, ['title']);
        return $this->response->paginator($files->paginate($paginate), new FileTransformer);
    }
    public function deleteFile(Request $request, $fileId)
    {
        $file = File::findOrFail($fileId);
        if (!$this->hasPermissions($request, $file, 'manage_files')) {
            return $this->response->errorForbidden();
        }
        if (!empty($recording->path)) {
          
              $path = implode(DIRECTORY_SEPARATOR, array(public_path('/fs/files'), $file->path));
              if (!unlink($path)) {
                throw new \Exception("could not delete recording file..");
              }
        }
        $file->delete();
   }
  public function upload(Request $request) {
      $creds = ApiCredentialKVStore::getRecord();
      // 2. Map the KV pairs to the Laravel filesystem config
      // We check for existence to avoid null errors if the DB keys are missing
      config([
          'filesystems.disks.s3.key'    => $creds['aws_access_key_id'],
          'filesystems.disks.s3.secret' => $creds['aws_secret_access_key'],
          'filesystems.disks.s3.region' => $creds['aws_region'],
          'filesystems.disks.s3.bucket' => $creds['s3_bucket']

      ]);
      $results = $this->uploadFiles($request);
      return $this->response->array($results);
   }
  public function uploadByGoogleDrive(Request $request) {
    $data = $request->json()->all();
    $token = $data['accessToken'];
    $workspace = $this->getWorkspace($request);
    $client = MainHelper::createGoogleClientForUser($token);
    $service = new \Google_Service_Drive($client);
    // Until we have reached the EOF, read 1024 bytes at a time and write to the output file handle.
    $files = [];
    foreach ($data['files'] as $id) {
       $gFile = $service->files->get($id);
        $content = $service->files->get($id, array("alt" => "media"));
        $size= (int) $content->getHeader('Content-Length')[0];

      $files[] = [
            'title' => $gFile->getName(),
            'extension' => MainHelper::determineExtensionFromMime($gFile->mimeType),
            //'extension' => $gFile->fullFileExtension,
            //'size' => $gFile->fileSize,
            'size' => $size,
            'content' => $content,
            'gFile' => $gFile
      ];
    }
    $amountFailed = 0;
    $payload = [];
    $results = [];
    foreach ($files as $file) {
      $result = [];
      $title = $file['title'];
      $extension = $file['extension'];
      $size = $file['size'];
      $gFile = $file['gFile'];
      $content = $file['content'];
      if ( !$this->checkIfCanUploadFile($title, $extension, $size)) { 
        $amountFailed ++;
        $result['success'] = FALSE;
        $results[]= $result;
      } else {
        $path = 
        $path = uniqid(TRUE).".".$extension;       
        $fullPath = public_path("fs/files/" .$path);
        $outHandle = fopen($fullPath, "w+");
        while (!$content->getBody()->eof()) {
                
                fwrite($outHandle, $content->getBody()->read(1024));
        }
          $result['success'] = TRUE;    
          $file = File::create([
              'workspace_id' => $workspace->id,
              'path' => $path,
              'title' => $title
          ]);
          $result['file'] = $file->toArray();

        fclose($outHandle);
        $results[] = $result;
      }
    }
      $payload['results'] = $results;
      return $this->response->array($payload);
   }


   private function uploadFiles(Request $request) {
     $workspace = $this->getWorkspace($request);
     $files = \Input::file("file");
     $results = [];
     $payload = [];
      $amountFailed = 0;
      $user = $this->getUser($request);
     foreach ($files as $file) {
       $uploaded = $this->uploadFile($user, $file);
        $result = [];
        $result['success'] = FALSE;
       if($uploaded) {
          $result['success'] = TRUE;
         $file = File::create([
            'workspace_id' => $workspace->id,
            'path' => $uploaded['path'],
            'title' => $uploaded['title'],
         ]);
          $result['file'] = $file->toArray();
            $results[] = $result;
        } else {
          $amountFailed ++;
            $results[] = $result;
        }
     }
      $payload['results'] = $results;
      $payload['amountFailed'] = $amountFailed;
      return $payload;
   }

  private function uploadFile($user, $file) {
      // 3. Validation and Setup
      if (!$file->isValid()) {
          \Log::error("file invalid");
          return FALSE;
      }

      $size = $file->getSize();
      $extension = $file->guessExtension();
      $title = $file->getClientOriginalName();

      if (!in_array($extension, self::$acceptedFileFormats) || $size > self::$maxFileSizeBytes) {
          return FALSE;
      }

      \Log::info(sprintf("uploading file: %s (size: %d)", $title, $size));

      // 4. Instantiate the disk (it will now use the injected config)
      $s3 = \Storage::disk('s3');
      $path = uniqid(TRUE) . "." . $extension;
      $filePath = '/files/' . $path;

      try {
          $result = $s3->put($filePath, file_get_contents($file->getRealPath()), 'public');
          
          if (!$result) {
              return FALSE;
          }

          return compact('title', 'path');

      } catch (\Exception $e) {
          \Log::error("S3 Upload Failed: " . $e->getMessage());
          return FALSE;
      }
  }
   public function checkIfCanUploadFile($title, $extension, $size) {
        \Log::info(sprintf("uploading file size: %d, format is %s", $size, $extension));
        if (!in_array($extension, self::$acceptedFileFormats)) {
          return FALSE;
        }
        $path = uniqid(TRUE).".".$extension;
        if ( $size > self::$maxFileSizeBytes ) {
          return FALSE;
        }
        return TRUE;

   }

}

