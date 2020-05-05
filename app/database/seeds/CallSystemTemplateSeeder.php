<?php

use Illuminate\Database\Seeder;
use App\CallSystemTemplate;
use App\Helpers\MainHelper;
class CallSystemTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $flows = [

          [
            'name' => 'Cold Transfer',
            'template' => 'Cold Transfer'
          ],
          [
            'name' => 'Check Voicemail',
            'template' => 'Check Voicemail'
          ],

          [
            'name' => 'Simple IVR',
            'template' => 'Simple IVR'
          ],
          [
            'name' => 'Call Forward',
            'template' => 'Call Forward'
          ]
       ];


        $extensions = [
          [
            'username' => '1000',
            'caller_id' => '1000',
            'flow_name' => 'Call Forward'
          ],
          [
            'username' => '2000',
            'caller_id' => '2000',
            'flow_name' => 'Call Forward'
          ]
        ];
        $codes = [
          [
            'code' => '*72',
          'name' => 'Cold Transfer',
          'flow_name' => 'Cold Transfer',
          ],
          [
            'code' => '*73',
          'name' => 'Warm Transfer',
          'flow_name' => 'Warm Transfer'
          ],
          [
            'code' => '*97',
          'name' => 'Check Voicemail',
          'flow_name' => 'Check Voicemail'
          ],


        ];        
        $template = array(
          "extensions" => $extensions,
          "extension_codes" => $codes,
          "flows" => $flows
        );
        CallSystemTemplate::create([
          'name' => 'Basic Call System',
          'description' => 'Includes 2 extensions, call forwarding, cold transfers and a simple IVR setup',
          'data' => json_encode($template)
        ]);
    }
}
