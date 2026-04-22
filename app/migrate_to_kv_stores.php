<?php

use App\Customizations;
use App\CustomizationsKVStore;
use App\ApiCredential;
use App\ApiCredentialKVStore;

// BEWARE this will remove all the data in any relevant KV store tables.
// please only run this to load the data from the older tables
$customizations = Customizations::getRecord();
$columns = Customizations::getColumns();

echo "MIGRATING customizations table".PHP_EOL;
foreach ($columns as $column) {
    $value = $customizations->{$column};
    if (is_string($value)) {
		CustomizationsKVStore::upsert($column, 'string_value', $value);
    } else if (is_bool($value)) {
		CustomizationsKVStore::upsert($column, 'boolean_value', $value);
    }
}

echo "done migrating".PHP_EOL;


echo "MIGRATING api credentials table".PHP_EOL;
$apiCreds = ApiCredential::getRecord();
$columns = ApiCredential::getColumns();
foreach ($columns as $column) {
    $value = $apiCreds->{$column};
    if (is_string($value)) {
		ApiCredentialKVStore::upsert($column, 'string_value', $value);
    } else if (is_bool($value)) {
		ApiCredentialKVStore::upsert($column, 'boolean_value', $value);
    }
}

echo "done migrating".PHP_EOL;
echo "all done".PHP_EOL;