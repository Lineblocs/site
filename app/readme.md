# Lineblocs backend

## requirements

```
PHP 7
laravel 5
```


## config

1. move .env.example to .env
2. change .env file


## installing

1. php migrate
2. php db:seed
3. load flow template fixtures
```
mysql -u oneline_cloud -p
use oneline_cloud;
source sql-backups/flows_templates_2.sql
```
3. run migrations
```
php artisan tinker
require("./run_migrations.php");
```

