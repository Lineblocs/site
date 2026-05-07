<?php

namespace App\Services;

use App\BlockedNumber;
use App\Helpers\MainHelper;
use DB;

class BlockedNumberImportService
{
    const CHUNK_SIZE = 500;

    public function import($filePath, $userId, $workspaceId)
    {
        $handle = fopen($filePath, 'r');
        if (!$handle) {
            throw new \Exception('Could not read the uploaded file.');
        }

        $importedCount = 0;
        $skippedCount = 0;
        $seenNumbers = [];
        $chunk = [];

        while (($row = fgetcsv($handle)) !== false) {
            $record = $this->getBlockedNumberFromCsvRow($row);
            $number = $record['number'];

            if ($this->isHeaderRow($row)) {
                continue;
            }

            if (!$this->isValidPhoneNumber($record['original_number'])) {
                $skippedCount++;
                continue;
            }

            if (isset($seenNumbers[$number])) {
                $skippedCount++;
                continue;
            }

            $seenNumbers[$number] = true;
            $chunk[] = $record;

            if (count($chunk) >= self::CHUNK_SIZE) {
                $result = $this->insertBlockedNumberChunk($chunk, $userId, $workspaceId);
                $importedCount = $importedCount + $result['imported_count'];
                $skippedCount = $skippedCount + $result['skipped_count'];
                $chunk = [];
            }
        }

        fclose($handle);

        if (count($chunk) > 0) {
            $result = $this->insertBlockedNumberChunk($chunk, $userId, $workspaceId);
            $importedCount = $importedCount + $result['imported_count'];
            $skippedCount = $skippedCount + $result['skipped_count'];
        }

        return [
            'imported_count' => $importedCount,
            'skipped_count' => $skippedCount
        ];
    }

    private function getBlockedNumberFromCsvRow($row)
    {
        $originalNumber = '';
        $number = '';

        if (!isset($row[0])) {
            return [
                'number' => $number,
                'original_number' => $originalNumber,
                'reason' => ''
            ];
        }

        $originalNumber = trim($row[0]);
        $number = preg_replace('/\s+/', '', $originalNumber);

        if (substr($number, 0, 1) == '+') {
            $number = substr($number, 1);
        }

        $reason = '';
        if (isset($row[1])) {
            $reason = trim($row[1]);
        }

        return [
            'number' => $number,
            'original_number' => $originalNumber,
            'reason' => $reason
        ];
    }

    private function isHeaderRow($row)
    {
        if (!isset($row[0])) {
            return false;
        }

        return strtolower(trim($row[0])) == 'number';
    }

    private function isValidPhoneNumber($number)
    {
        if ($number == '') {
            return false;
        }

        if (substr($number, 0, 1) != '+') {
            return false;
        }

        $number = substr(preg_replace('/\s+/', '', $number), 1);

        if (!ctype_digit($number)) {
            return false;
        }

        return true;
    }

    private function insertBlockedNumberChunk($records, $userId, $workspaceId)
    {
        $numbers = [];
        foreach ($records as $record) {
            $numbers[] = $record['number'];
        }

        $existingNumbers = DB::table('blocked_numbers')
            ->where('workspace_id', $workspaceId)
            ->whereIn('number', $numbers)
            ->lists('number');

        $existingLookup = [];
        foreach ($existingNumbers as $existingNumber) {
            $existingLookup[$existingNumber] = true;
        }

        $now = date('Y-m-d H:i:s');
        $rows = [];
        $skippedCount = 0;

        foreach ($records as $record) {
            $number = $record['number'];

            if (isset($existingLookup[$number])) {
                $skippedCount++;
                continue;
            }

            $rows[] = [
                'public_id' => MainHelper::createApiId(BlockedNumber::$publicPrefix),
                'user_id' => $userId,
                'workspace_id' => $workspaceId,
                'number' => $number,
                'reason' => $record['reason'],
                'created_at' => $now,
                'updated_at' => $now
            ];
        }

        if (count($rows) > 0) {
            DB::table('blocked_numbers')->insert($rows);
        }

        return [
            'imported_count' => count($rows),
            'skipped_count' => $skippedCount
        ];
    }
}
