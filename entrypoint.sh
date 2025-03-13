#!/bin/sh

# Exit on error
set -e

# Wait for MySQL to be ready
echo "Waiting for MySQL to be ready..."
for i in {1..30}; do
  if php -r "try { new PDO('mysql:host=${DB_HOST};dbname=${DB_DATABASE}', '${DB_USERNAME}', '${DB_PASSWORD}'); echo 'Database is ready!'; exit(0); } catch (Exception \$e) { echo 'Waiting...'; sleep(5); }"; then
    break
  fi
done

echo "* * * * * cd /var/www && php artisan app:get-whmcs-data >> /dev/null 2>&1" > /etc/cron.d/laravel-cron
chmod 0644 /etc/cron.d/laravel-cron
crontab /etc/cron.d/laravel-cron
touch /var/log/cron.log
service cron start

# Set correct permissions
chmod -R 777 storage bootstrap/cache

# Run database migrations and seeders
php artisan migrate --force
# php artisan db:seed --force
# php artisan db:seed --class=AdminSeeder

# Start PHP-FPM
echo "Starting PHP-FPM..."
exec php-fpm