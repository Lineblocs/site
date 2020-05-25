<?php

use Illuminate\Database\Seeder;
use App\Flow;
use App\User;

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
        $username = getenv('DB_USERNAME');
        $host = getenv('DB_HOST');
        $password = getenv('DB_PASSWORD');
        $database = getenv('DB_DATABASE');

        $command = "mysql -h $host -u $username -p$password  $database < $abs";
        $result = exec($command);
        if ($result != 0) {
            die("error when importing flows dump..");
        }

    }
}
