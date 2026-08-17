<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Recording;
use Illuminate\Support\Facades\Log;
use Exception;

class BackfillRecordingS3Keys extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'recordings:backfill-s3-keys {--dry-run : Simulate the update without saving to the database}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate s3_key column using the file name portion from s3_url for all recordings (Laravel 5.1 compatible).';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $isDryRun = $this->option('dry-run');

        if ($isDryRun) {
            $this->warn('--- DRY RUN MODE ENABLED (No changes will be saved) ---');
        }

        directive: $this->info('Starting S3 key backfill process...');
        Log::info('Starting BackfillRecordingS3Keys Artisan Command.');

        try {
            $updatedCount = 0;
            $lastId = 0;
            $chunkSize = 500;

            // Manual ID-cursor loop to safely process records without offset skipping issues
            while (true) {
                $recordings = Recording::whereNull('s3_key')
                    ->whereNotNull('s3_url')
                    ->where('id', '>', $lastId)
                    ->orderBy('id', 'asc')
                    ->take($chunkSize)
                    ->get();

                if ($recordings->isEmpty()) {
                    break;
                }

                foreach ($recordings as $recording) {
                    $lastId = $recording->id;

                    $path = parse_url($recording->s3_url, PHP_URL_PATH);
                    $fileName = basename($path);

                    if (!empty($fileName)) {
                        if (!$isDryRun) {
                            $recording->s3_key = $fileName;
                            $recording->save();
                        }

                        $updatedCount++;
                        $this->line("Processed Recording ID: {$recording->id} -> s3_key: {$fileName}");
                    }
                }
            }

            $this->info("Successfully backfilled {$updatedCount} recording records.");
            Log::info("BackfillRecordingS3Keys completed successfully. Updated records: {$updatedCount}");

            return 0;

        } catch (Exception $e) {
            $this->error('Error during S3 key backfill: ' . $e->getMessage());
            Log::error('Error in BackfillRecordingS3Keys: ' . $e->getMessage());
            return 1;
        }
    }
}