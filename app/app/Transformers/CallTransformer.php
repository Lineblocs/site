<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use \DB;
use \Config;
use App\Call;
use App\Helpers\MainHelper;

final class CallTransformer extends TransformerAbstract {
    public function aiSummary(Call $call)
    {
        if (!$call->relationLoaded('speakers')) {
            $call->load('speakers');
        }
        if (!$call->relationLoaded('chapters')) {
            $call->load('chapters');
        }
        if (!$call->relationLoaded('actionItems')) {
            $call->load('actionItems');
        }

        return [
            'speakers' => $call->speakers->map(function ($speaker) {
                return [
                    'id' => $speaker->id,
                    'speaker_name' => $speaker->speaker_name,
                    'start_talk_time' => (float) $speaker->start_talk_time,
                    'end_talk_time' => (float) $speaker->end_talk_time,
                ];
            })->values()->toArray(),
            'chapters' => $call->chapters->map(function ($chapter) {
                return [
                    'id' => $chapter->id,
                    'title' => $chapter->title,
                    'summary' => $chapter->summary,
                    'start_time' => (float) $chapter->start_time,
                ];
            })->values()->toArray(),
            'action_items' => $call->actionItems->map(function ($item) {
                return [
                    'id' => $item->id,
                    'speaker_id' => $item->speaker_id,
                    'action_item' => $item->action_item,
                    'status' => $item->status,
                    'priority' => $item->priority,
                ];
            })->values()->toArray(),
        ];
    }

     public function transform(Call $call)
    {
        $array = $call->toArray();
        $createdAt = $call['created_at'];
        $updatedAt = $call['updated_at'];

        $array['friendly_duration'] = MainHelper::formatDuration($array['duration']);
        $array['friendly_dates'] = [
            'created_at' => MainHelper::createHumanReadableDate($createdAt),
            'updated_at' => MainHelper::createHumanReadableDate($updatedAt),
        ];
        $array['ai_summary'] = $this->aiSummary($call);
        unset($array['speakers'], $array['chapters'], $array['action_items']);
        return $array;
    }
}
