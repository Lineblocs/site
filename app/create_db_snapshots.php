<?php

use App\User;
use App\Workspace;
use App\ApiCredential;
use App\Customizations;
use App\Helpers\MainHelper;
use App\Helpers\SIPRouterHelper;
use Illuminate\Support\Facades\Schema;

if (!function_exists("backup_database")) {
    function backup_database($database='') {
        // for more info about this command refer to
        // 
        echo "Creating lineblocs.sql" .PHP_EOL;
        //$filename = "backup-" . Carbon::now()->format('Y-m-d') . ".sql";
        $filename = "${database}.sql";
        // Create backup folder and set permission if not exist.
        $storageAt = storage_path() . "/app/backup/";
        if(!File::exists($storageAt)) {
            File::makeDirectory($storageAt, 0755, true, true);
        }
        $command = "".env('DB_DUMP_PATH', 'mysqldump')." --user=" . env('DB_USERNAME') ." --password=" . env('DB_PASSWORD') . " --host=" . env('DB_HOST') . " " . $database . " --no-tablespaces | gzip > " . $storageAt . $filename;
        $returnVar = NULL;
        $output = NULL;
        return exec($command, $output, $returnVar);
    }
}

if (!function_exists("run_artisan_command")) {
    function run_artisan_command($command) {
        $command = "php artisan " . $command;
        $returnVar = NULL;
        $output = NULL;
        echo "running command " . $command . PHP_EOL;
        return exec($command, $output, $returnVar);
    }
}

if (!function_exists("clean_table_columns")) {
    function clean_table_columns($record) {
        $columns = collect($record)->keys();
        $updateAttrs = [];
        foreach ( $columns as $col ) {
            $updateAttrs[$col] = "";
        }
        $record->update($updateAttrs);
    }
}

if (!function_exists("confirm_action")) {
    // Function to prompt user for confirmation
    function confirm_action() {
        echo "Are you sure you want to proceed? (yes/no): ";
        $handle = fopen ("php://stdin","r");
        $line = fgets($handle);
        $response = trim($line);
        fclose($handle);
        return $response;
    }
}

// Example usage
echo "This will remove all data from the lineblocs and opensips databases. Are you sure you want to proceed ?\n";
$confirmation = confirm_action();

if ($confirmation != 'yes') {
    echo "Action canceled.\n";
    die;
}


// Disable foreign key checks
DB::statement('SET FOREIGN_KEY_CHECKS=0;');

echo "Removing workspaces" .PHP_EOL;
echo var_dump( DB::table('recordings')->delete() );
echo var_dump( DB::table('calls')->delete() );
echo var_dump( DB::table('port_numbers_documents')->delete() );
echo var_dump( DB::table('widget_templates_tags')->delete() );
echo var_dump( DB::table('workspaces_events_properties')->delete() );
echo var_dump( DB::table('workspaces_events')->delete() );
echo var_dump( DB::table('workspaces')->delete() );


echo "Removing users" .PHP_EOL;
echo var_dump( DB::table('users')->delete() );

echo "Removing sip data" .PHP_EOL;
echo var_dump( DB::table('sip_routers')->delete() );
echo var_dump( DB::table('media_servers')->delete() );
echo var_dump( DB::table('sip_providers')->delete() );
echo var_dump( DB::table('sip_routing_acl')->delete() );
echo var_dump( DB::table('rtpproxy_sockets')->delete() );
echo var_dump( DB::table('sip_countries')->delete() );
echo var_dump( DB::table('call_rates')->delete() );
echo var_dump( DB::table('number_inventory')->delete() );
echo var_dump( DB::table('faqs')->delete() );
echo var_dump( DB::table('service_plans')->delete() );
echo var_dump( DB::table('company_representatives')->delete() );
echo var_dump( DB::table('dns_records')->delete() );
echo var_dump( DB::table('error_user_trace')->delete() );
echo var_dump( DB::table('service_plans')->delete() );
echo var_dump( DB::table('call_system_templates')->delete() );

echo "Removing phon provisioner tables" .PHP_EOL;
echo var_dump( DB::table('phones_definitions')->delete() );

echo "Removing customizations tables" .PHP_EOL;
echo var_dump( DB::table('api_credentials')->delete() );
echo var_dump( DB::table('customizations')->delete() );


echo "Removing system status data" .PHP_EOL;
echo var_dump( DB::table('system_status_categories')->delete() );

echo "Removing opensips data" .PHP_EOL;

echo var_dump( SIPRouterHelper::removeAllUserData() );

echo "adding seed data".PHP_EOL;
echo var_dump(run_artisan_command('db:seed') );

$lineblocs_database = env('DB_NAME');

echo "creating db snapshot for lineblocs" .PHP_EOL;
backup_database($lineblocs_database);

$opensips_database = env('DB_OPENSIPS_DATABASE');

echo "creating db snapshot for opensips" .PHP_EOL;
backup_database($opensips_database);

echo "All tasks complete.".PHP_EOL;

// Enable foreign key checks
DB::statement('SET FOREIGN_KEY_CHECKS=1;');