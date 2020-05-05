<?php

use Illuminate\Database\Seeder;
use App\Call;
use App\Recording;
use App\User;
use App\Workspace;

class LoadSampleCalls extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
      $user = User::where('email', '=', 'user@lineblocs.com')->firstOrFail();
      $workspace = Workspace::where('creator_id', '=', $user->id)->firstOrFail();
      $started1 = DateTime::createFromFormat('j-M-Y H:i:s', '01-Jul-2019 09:00:00');
      $ended1 = clone $started1;
      $ended1->add(new DateInterval('PT1M'));
      $started2 = DateTime::createFromFormat('j-M-Y H:i:s', '01-Jul-2019 12:00:00');
      $ended2 = clone $started2;
      $ended2->add(new DateInterval('PT5M'));

      $call1 = Call::create([
        'from' => '15874874526',
        'from' => '15878557657',
        'status' => 'completed',
        'direction' => 'inbound',
        'duration' => 3600,
        'user_id' => $user->id,
        'workspace_id' => $workspace->id,
        'started_at' => $started1,
        'ended_at' => $ended1
      ]);
      $recording1 = Recording::create([
        'uri' => 'http://recordings.onelinepbx.com/user-id/test.wav',
        'status' => 'completed',
        'user_id' => $user->id,
        'call_id' => $call1->id,
        'workspace_id' => $workspace->id,
      ]);
      $recording2 = Recording::create([
        'uri' => 'http://recordings.onelinepbx.com/user-id/test.wav',
        'status' => 'completed',
        'user_id' => $user->id,
        'call_id' => $call1->id,
        'workspace_id' => $workspace->id,
      ]);
      $call2 = Call::create([
        'from' => '15874874526',
        'from' => '15878557657',
        'status' => 'completed',
        'direction' => 'inbound',
        'duration' => 3600,
        'user_id' => $user->id,
        'started_at' => $started2,
        'ended_at' => $ended2,
        'workspace_id' => $workspace->id,
      ]);
      $recording3 = Recording::create([
        'uri' => 'http://recordings.onelinepbx.com/user-id/test.wav',
        'status' => 'completed',
        'user_id' => $user->id,
        'call_id' => $call2->id,
        'workspace_id' => $workspace->id,
      ]);


    }
}
