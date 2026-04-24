<?php

/**
 * Bootstrap Laravel 5.1
 */
require __DIR__.'/vendor/autoload.php';

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Aws\S3\S3Client;

// Config from .env
$bucket = env('AWS_S3_BUCKET');
$region = env('AWS_DEFAULT_REGION', 'us-east-1');

$s3 = new S3Client([
    'version' => 'latest',
    'region'  => $region,
]);

echo "--- Starting S3 Match & Finalize (Folder: recordings/) ---\n";

try {
    $paginator = $s3->getPaginator('ListObjects', [
        'Bucket' => $bucket,
        'Prefix' => 'recordings/' 
    ]);

    foreach ($paginator as $result) {
        $objects = $result->get('Contents');

        if (empty($objects)) {
            continue;
        }

        foreach ($objects as $object) {
            $s3Key = $object['Key'];

            // Log every key being processed
            $processMsg = "Processing S3 Key: " . $s3Key;
            echo $processMsg . "\n";
            Log::info($processMsg);

            // Skip folder placeholder or non-wav files
            if ($s3Key === 'recordings/' || pathinfo($s3Key, PATHINFO_EXTENSION) !== 'wav') {
                continue;
            }

            // Extract "1234" from "recordings/1234.wav"
            $storageId = pathinfo($s3Key, PATHINFO_FILENAME);

            // Database match
            $recording = DB::table('recordings')
                ->where('storage_id', $storageId)
                ->first();

            if ($recording) {
                $publicUrl = $s3->getObjectUrl($bucket, $s3Key);

                // Update database
                DB::table('recordings')
                    ->where('id', $recording->id)
                    ->update([
                        's3_url' => $publicUrl,
                        'status' => 'FINALIZED'
                    ]);

                $successMsg = "MATCH FOUND: Updated ID {$storageId} to FINALIZED.";
                echo $successMsg . "\n";
                Log::info($successMsg);
            }
        }
    }

    echo "--- Sync Completed ---\n";

} catch (\Exception $e) {
    $errorMsg = "S3 Sync Failed: " . $e->getMessage();
    Log::error($errorMsg);
    fwrite(STDERR, $errorMsg . PHP_EOL);
    exit(1);
}