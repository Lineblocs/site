<?php

use App\Helpers\MainHelper;
        $abs = base_path("/sql-backups/flows_templates.sql");
        $username = getenv('DB_USERNAME');
        $host = getenv('DB_HOST');
        $password = getenv('DB_PASSWORD');
        $database = getenv('DB_DATABASE');

        $command = "mysql -u $username -p$password  $database < $abs";
        $result = exec($command);
        if ($result != 0) {
            die("error when importing flows dump..");
        }

