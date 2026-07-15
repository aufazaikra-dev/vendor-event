#!/bin/sh

echo "=== Starting EventVendor ==="
echo "PHP Version: $(php --version | head -1)"
echo "APP_ENV: $APP_ENV"
echo "DB_HOST: $DB_HOST"
echo "DB_PORT: $DB_PORT"
echo "DB_DATABASE: $DB_DATABASE"

# Ensure storage directories exist and have correct permissions
mkdir -p /var/www/storage/framework/sessions
mkdir -p /var/www/storage/framework/views
mkdir -p /var/www/storage/framework/cache
mkdir -p /var/www/storage/logs
mkdir -p /var/www/bootstrap/cache
chmod -R 775 /var/www/storage /var/www/bootstrap/cache

echo "--- Clearing config..."
php artisan config:clear || true

echo "--- Caching config..."
php artisan config:cache || true

echo "--- Clearing routes..."
php artisan route:clear || true

echo "--- Caching routes..."
php artisan route:cache || true

echo "--- Running migrations..."
php artisan migrate --force
MIGRATE_STATUS=$?
if [ $MIGRATE_STATUS -ne 0 ]; then
    echo "WARNING: Migration failed with status $MIGRATE_STATUS"
    echo "Continuing to start server..."
fi

echo "--- Running AdminSeeder..."
php artisan db:seed --class=AdminSeeder --force || echo "WARNING: Seeder failed"

echo "--- Creating storage link..."
php artisan storage:link || true

echo "--- Starting server on port 8080..."
exec php artisan serve --host=0.0.0.0 --port=8080
