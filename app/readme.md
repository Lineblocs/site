# Lineblocs backend

[![Alt text](https://github.com/Lineblocs/site/actions/workflows/ci.yml/badge.svg)](https://github.com/Lineblocs/site/actions/workflows/ci.yml/badge.svg)
## requirements

```
PHP 7.4
laravel 5.1
```


## config

1. move .env.example to .env
2. change .env file


## installing

1. php migrate
2. php db:seed
3. load flow template fixtures
```
mysql -u lineblocs -p
use lineblocs;
source sql-backups/flows_templates_2.sql
```
3. run migrations
```
php artisan tinker
require("./run_migrations.php");
```

# lint codebase

You can review the code for any possible code smell by running the PHPcs linter.

For more info on how to install PHPcs please refer to [https://github.com/squizlabs/PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer)

To run the linter please use the following command:

```
phpcs.phar ./app/
```