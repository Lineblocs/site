<?php

namespace App\Jobs;

use App\Services\BlockedNumberImportService;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Log;

class ImportBlockedNumbers extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $filePath;
    protected $userId;
    protected $workspaceId;

    public function __construct($filePath, $userId, $workspaceId)
    {
        $this->filePath = $filePath;
        $this->userId = $userId;
        $this->workspaceId = $workspaceId;
    }

    public function handle(BlockedNumberImportService $service)
    {
        try {
            $result = $service->import($this->filePath, $this->userId, $this->workspaceId);

            Log::info('Blocked number import completed.', [
                'user_id' => $this->userId,
                'workspace_id' => $this->workspaceId,
                'imported_count' => $result['imported_count'],
                'skipped_count' => $result['skipped_count']
            ]);

            if (file_exists($this->filePath)) {
                unlink($this->filePath);
            }
        } catch (\Exception $ex) {
            Log::error('Blocked number import failed: ' . $ex->getMessage());

            throw $ex;
        }
    }
}
