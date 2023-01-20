#! /bin/bash
## generate keys
echo "Generating app keys..."
KEY=$(php artisan key:generate --show) && echo "APP_KEY=${KEY}" >>  .env 

echo "Refreshing all caches..."
./clear_caches.sh

echo "Running web server"
apache2-foreground