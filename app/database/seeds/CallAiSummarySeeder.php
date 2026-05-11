<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Call;
use App\CallSpeaker;
use App\CallChapter;
use App\CallActionItem;
use App\User;
use App\Workspace;

class CallAiSummarySeeder extends Seeder
{
    private $sampleCalls = [
        [
            'from' => '+14035698719',
            'to' => '17804255367',
            'direction' => 'OUTBOUND',
            'title_one' => 'Introduction and Project Overview',
            'summary_one' => 'The team discussed the current status of the software framework migration and identified immediate blockers in the dev server environment.',
            'title_two' => 'Infrastructure Scaling',
            'summary_two' => 'Review of the high-scale infrastructure requirements for the upcoming Q3 release, focusing on database optimization and load balancing.',
            'action_one' => 'Deploy the latest C module updates to the staging environment for real-time audio testing.',
            'action_two' => 'Review RabbitMQ queue consumer logs for potential latency issues in the Laravel worker.',
        ],
        [
            'from' => '+16475550101',
            'to' => '12065550144',
            'direction' => 'OUTBOUND',
            'title_one' => 'Customer Onboarding Review',
            'summary_one' => 'The onboarding flow was reviewed with emphasis on reducing manual setup work and improving first-login guidance.',
            'title_two' => 'Billing Follow Up',
            'summary_two' => 'The team agreed to confirm payment status handling and invoice email delivery before the next release.',
            'action_one' => 'Validate the onboarding checklist against the latest workspace setup flow.',
            'action_two' => 'Confirm invoice email attachments are generated for monthly and annual invoices.',
        ],
        [
            'from' => '+12125550122',
            'to' => '14165550133',
            'direction' => 'INBOUND',
            'title_one' => 'Support Escalation',
            'summary_one' => 'The customer reported intermittent call routing failures and shared timestamps for investigation.',
            'title_two' => 'Resolution Planning',
            'summary_two' => 'Engineering agreed to inspect SIP provider logs and compare call IDs across the routing stack.',
            'action_one' => 'Pull SIP logs for the reported call window and attach them to the support ticket.',
            'action_two' => 'Send the customer a status update after provider-side validation is complete.',
        ],
        [
            'from' => '+13125550155',
            'to' => '15145550166',
            'direction' => 'OUTBOUND',
            'title_one' => 'Product Feedback',
            'summary_one' => 'Participants reviewed dashboard usability feedback and discussed improving call analytics visibility.',
            'title_two' => 'AI Summary Enhancements',
            'summary_two' => 'The team proposed grouping speakers, chapters, and action items in a single API response object.',
            'action_one' => 'Add frontend states for calls with empty AI summaries.',
            'action_two' => 'Document the API response shape for call AI summary data.',
        ],
        [
            'from' => '+16135550177',
            'to' => '19025550188',
            'direction' => 'INBOUND',
            'title_one' => 'Renewal Discussion',
            'summary_one' => 'The account team reviewed renewal timing, usage patterns, and expected seat changes for the next term.',
            'title_two' => 'Commercial Next Steps',
            'summary_two' => 'The customer requested a revised proposal and a short technical validation session.',
            'action_one' => 'Prepare the renewal proposal with updated workspace user counts.',
            'action_two' => 'Schedule a technical validation call with the customer admin.',
        ],
    ];

    public function run()
    {
        $user = $this->resolveUser();
        $workspace = $this->resolveWorkspace($user);
        $calls = $this->resolveCalls($user, $workspace);

        foreach ($calls as $index => $call) {
            $sample = $this->sampleCalls[$index % count($this->sampleCalls)];
            $this->refreshAiSummary($call, $sample);
        }

        $this->command->info(sprintf(
            'Seeded AI summary data for %d calls in workspace #%d.',
            count($calls),
            $workspace->id
        ));
    }

    private function resolveUser()
    {
        $userId = env('CALL_AI_SUMMARY_USER_ID', 333);
        $user = User::find($userId);
        if ($user) {
            return $user;
        }

        return User::firstOrFail();
    }

    private function resolveWorkspace(User $user)
    {
        $workspaceId = env('CALL_AI_SUMMARY_WORKSPACE_ID', 306);
        $workspace = Workspace::find($workspaceId);
        if ($workspace) {
            return $workspace;
        }

        $workspace = Workspace::where('creator_id', $user->id)->first();
        if ($workspace) {
            return $workspace;
        }

        return Workspace::firstOrFail();
    }

    private function resolveCalls(User $user, Workspace $workspace)
    {
        $calls = Call::where('workspace_id', $workspace->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->all();

        while (count($calls) < 5) {
            $sample = $this->sampleCalls[count($calls) % count($this->sampleCalls)];
            $calls[] = $this->createCall($user, $workspace, $sample, count($calls));
        }

        return array_slice($calls, 0, 5);
    }

    private function createCall(User $user, Workspace $workspace, array $sample, $index)
    {
        $started = new DateTime(sprintf('2026-05-0%d 16:%02d:00', $index + 1, 10 + $index));
        $ended = clone $started;
        $ended->add(new DateInterval('PT3M11S'));

        $attrs = [
            'from' => $sample['from'],
            'to' => $sample['to'],
            'status' => 'ENDED',
            'direction' => $sample['direction'],
            'duration' => 191,
            'user_id' => $user->id,
            'workspace_id' => $workspace->id,
            'started_at' => $started,
            'ended_at' => $ended,
            'created_at' => $started,
            'updated_at' => $ended,
        ];

        $optional = [
            'notes' => '',
            'plan_snapshot' => 'new_plan',
            'billed' => 0,
            'sip_status' => 200,
        ];

        foreach ($optional as $column => $value) {
            if (Schema::hasColumn('calls', $column)) {
                $attrs[$column] = $value;
            }
        }

        return Call::create($attrs);
    }

    private function refreshAiSummary(Call $call, array $sample)
    {
        CallActionItem::where('call_id', $call->id)->delete();
        CallChapter::where('call_id', $call->id)->delete();
        CallSpeaker::where('call_id', $call->id)->delete();

        $speakerOne = CallSpeaker::create([
            'call_id' => $call->id,
            'speaker_name' => 'Speaker 1',
            'start_talk_time' => 0.5,
            'end_talk_time' => 120.4,
        ]);

        $speakerTwo = CallSpeaker::create([
            'call_id' => $call->id,
            'speaker_name' => 'Speaker 2',
            'start_talk_time' => 122.1,
            'end_talk_time' => 185.0,
        ]);

        CallChapter::create([
            'call_id' => $call->id,
            'title' => $sample['title_one'],
            'summary' => $sample['summary_one'],
            'start_time' => 0.0,
        ]);

        CallChapter::create([
            'call_id' => $call->id,
            'title' => $sample['title_two'],
            'summary' => $sample['summary_two'],
            'start_time' => 115.5,
        ]);

        CallActionItem::create([
            'call_id' => $call->id,
            'speaker_id' => $speakerOne->id,
            'action_item' => $sample['action_one'],
            'status' => 'pending',
            'priority' => 'high',
        ]);

        CallActionItem::create([
            'call_id' => $call->id,
            'speaker_id' => $speakerTwo->id,
            'action_item' => $sample['action_two'],
            'status' => 'pending',
            'priority' => 'medium',
        ]);
    }
}
