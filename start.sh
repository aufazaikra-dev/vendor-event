#!/bin/sh
set -e

echo "=== Starting EventVendor ==="

echo "--- Clearing config..."
php artisan config:clear || true

echo "--- Caching config..."
php artisan config:cache || true

echo "--- Clearing routes..."
php artisan route:clear || true

echo "--- Caching routes..."
php artisan route:cache || true

echo "--- Running migrations..."
php artisan migrate --force || echo "WARNING: Migration failed, check DB credentials"

echo "--- Running AdminSeeder..."
php artisan db:seed --class=AdminSeeder --force || echo "WARNING: Seeder failed"

echo "--- Creating storage link..."
php artisan storage:link || true

echo "--- Starting server on port 8080..."
exec php artisan serve --host=0.0.0.0 --port=8080
