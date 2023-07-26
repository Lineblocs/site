#! /bin/bash
## generate keys
echo "Generating app keys..."
KEY=$(php artisan key:generate --show) && echo "APP_KEY=${KEY}" >>  .env 

echo "Set up .env from enviroment"
{ \
    echo DB_HOST="$DB_HOST" ; \
    echo DB_USERNAME="$DB_USERNAME" ; \
    echo  DB_PASSWORD="$DB_PASSWORD" ; \
    echo  DB_DATABASE="$DB_DATABASE" ; \
    echo  DB_PORT="$DB_PORT" ; \
} >> .env


echo "Refreshing all caches..."
./shell_scripts/clear_caches.sh

echo "Running web server"
apache2-foreground