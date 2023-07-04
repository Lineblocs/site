echo "changing permissions for workdir"
chown -R "www-data:www-data" ./
echo "losening permissions for storagr folders"
chmod -R 0755 .
chmod -R 0777 storage logs caches
