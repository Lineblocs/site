## generate keys
echo "Generating app keys..."
php artisan key:generate

echo "Refreshing all caches..."
./clear_caches.sh

echo "Running web server"
apache2-foreground