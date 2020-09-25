<?php 
use Illuminate\Database\Seeder;
use App\Flow;
use App\User;
use App\FlowTemplate;
use App\FlowTemplatePreset;

class FlowTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $abs = base_path("/sql-backups/flows_templates.sql");
        $contents = file_get_contents($abs);
        \DB::unprepared($contents);
        $this->setupCallForwardDefaults();
        $this->setupBasicIVRDefaults();
        $this->setupVoicemailDefaults();
        $this->setupQueueDefaults();
    }
    private function setupCallForwardDefaults() {
        $template = FlowTemplate::where('name', 'Call Forward')->firstOrFail();
        $options = [
        'Extension',
        'Phone Number',
        ];
        FlowTemplatePreset::create([
        'template_id' => $template->id,
        'var_name' => 'TypeOfCall',
        'screen_name' => 'Type Of Call',
        'description' => 'What type of call do you want to make',
        'variable_type' => 'basic',
        'data_type' => 'select',
        'extras' => $options,
        'default' => 'Phone Number'
        ]);

        FlowTemplatePreset::create([
        'template_id' => $template->id,
        'var_name' => 'PhoneNumber',
        'screen_name' => 'Phone Number',
        'description' => 'The number to forward to',
        'variable_type' => 'basic',
        'data_type' => 'text',
        'default' => '',
        ]);

        FlowTemplatePreset::create([
        'template_id' => $template->id,
        'var_name' => 'Extension',
        'screen_name' => 'Extesion',
        'description' => 'The extension to forward to',
        'depends_on_field' => 'TypeOfCall',
        'depends_on_value' => 'Extension',
        'variable_type' => 'workspace_lookup',
        'data_type' => 'select'
        ]);
    }
    private function setupBasicIVRDefaults() {
        $template = FlowTemplate::where('name', 'Simple IVR')->firstOrFail();
$options = [
  'Extension',
  'Phone Number',
];
FlowTemplatePreset::create([
  'template_id' => $template->id,
  'var_name' => 'TypeOfCall1',
  'screen_name' => 'Type Of Call 1',
  'description' => 'What type of call do you want to make',
  'variable_type' => 'basic',
  'data_type' => 'select',
  'extras' => $options,
  'default' => 'Phone Number'
]);

FlowTemplatePreset::create([
  'template_id' => $template->id,
  'var_name' => 'PhoneNumber1',
  'screen_name' => 'Phone Number 1',
  'description' => 'The number to forward to',
  'variable_type' => 'basic',
  'data_type' => 'text',
  'default' => '',
]);

FlowTemplatePreset::create([
  'template_id' => $template->id,
  'var_name' => 'Extension1',
  'screen_name' => 'Extension',
  'description' => 'The extension to forward to',
  'depends_on_field' => 'TypeOfCall1',
  'depends_on_value' => 'Extension',
  'variable_type' => 'workspace_lookup',
  'data_type' => 'select'
]);



$options = [
  'Extension',
  'Phone Number',
];
FlowTemplatePreset::create([
  'template_id' => $template->id,
  'var_name' => 'TypeOfCall2',
  'screen_name' => 'Type Of Call 2',
  'description' => 'What type of call do you want to make',
  'variable_type' => 'basic',
  'data_type' => 'select',
  'extras' => $options,
  'default' => 'Phone Number'
]);

FlowTemplatePreset::create([
  'template_id' => $template->id,
  'var_name' => 'PhoneNumber2',
  'screen_name' => 'Phone Number 2',
  'description' => 'The number to forward to',
  'variable_type' => 'basic',
  'data_type' => 'text',
  'default' => '',
]);

FlowTemplatePreset::create([
  'template_id' => $template->id,
  'var_name' => 'Extension2',
  'screen_name' => 'Extension 2',
  'description' => 'The extension to forward to',
  'depends_on_field' => 'TypeOfCall2',
  'depends_on_value' => 'Extension',
  'variable_type' => 'workspace_lookup',
  'data_type' => 'select'
]);

$options = [
  'Extension',
  'Phone Number',
];
FlowTemplatePreset::create([
  'template_id' => $template->id,
  'var_name' => 'TypeOfCall3',
  'screen_name' => 'Type Of Call 3',
  'description' => 'What type of call do you want to make',
  'variable_type' => 'basic',
  'data_type' => 'select',
  'extras' => $options,
  'default' => 'Phone Number'
]);

FlowTemplatePreset::create([
  'template_id' => $template->id,
  'var_name' => 'PhoneNumber3',
  'screen_name' => 'Phone Number 3',
  'description' => 'The number to forward to',
  'variable_type' => 'basic',
  'data_type' => 'text',
  'default' => '',
]);

FlowTemplatePreset::create([
  'template_id' => $template->id,
  'var_name' => 'Extension3',
  'screen_name' => 'Extension 3',
  'description' => 'The extension to forward to',
  'depends_on_field' => 'TypeOfCall3',
  'depends_on_value' => 'Extension',
  'variable_type' => 'workspace_lookup',
  'data_type' => 'select'
]);

    }

    private function setupVoicemailDefaults() {
        $template = FlowTemplate::where('name', 'Voicemail Example')->firstOrFail();
FlowTemplatePreset::create([
  'template_id' => $template->id,
  'var_name' => 'ExtensionToCall',
  'screen_name' => 'Extension To Call',
  'description' => 'The extension to forward to',
  'variable_type' => 'workspace_lookup',
  'data_type' => 'select'
]);

FlowTemplatePreset::create([
  'template_id' => $template->id,
  'var_name' => 'Timeout',
  'screen_name' => 'Timeout',
  'description' => 'Call timeout',
  'variable_type' => 'basic',
  'data_type' => 'number',
  'default' => '30'
]);



    }
    private function setupQueueDefaults() {
        $template = FlowTemplate::where('name', 'Queue Example')->firstOrFail();


FlowTemplatePreset::create([
  'template_id' => $template->id,
  'var_name' => 'Extensions',
  'screen_name' => 'Queue Extensions',
  'description' => 'Extensions in the queue',
  'variable_type' => 'workspace_lookup',
  'data_type' => 'multi_select'
]);

FlowTemplatePreset::create([
  'template_id' => $template->id,
  'var_name' => 'MaxWaitTime',
  'screen_name' => 'Max Wait ime',
  'description' => 'Total time for caller to wait in queue',
  'variable_type' => 'basic',
  'data_type' => 'number',
  'default' => '60'
]);

FlowTemplatePreset::create([
  'template_id' => $template->id,
  'var_name' => 'MaxExtensionTimeout',
  'screen_name' => 'Max Extension Timeout',
  'description' => 'Total time call time per extension',
  'variable_type' => 'basic',
  'data_type' => 'number',
  'default' => '60'
]);


    }

}
