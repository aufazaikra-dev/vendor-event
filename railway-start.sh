#!/usr/bin/env bash
# railway-start.sh
# Script startup untuk Railway — dijalankan setiap kali container start

set -e

echo ">>> [Railway] Caching config..."
php artisan config:cache

echo ">>> [Railway] Caching routes..."
php artisan route:cache

echo ">>> [Railway] Running migrations..."
php artisan migrate --force

echo ">>> [Railway] Creating storage symlink..."
php artisan storage:link --force || true

echo ">>> [Railway] Starting server on port $PORT..."
php artisan serve --host=0.0.0.0 --port=$PORT
