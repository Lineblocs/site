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

