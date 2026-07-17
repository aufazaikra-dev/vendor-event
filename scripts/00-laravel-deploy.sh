#!/usr/bin/env bash

# =============================================================================
# 00-laravel-deploy.sh
# Script ini dijalankan otomatis oleh image richarvey/nginx-php-fpm saat
# container pertama kali start (karena RUN_SCRIPTS=1).
# Urutan eksekusi didasarkan pada nama file (alphabetical), jadi 00 = pertama.
# =============================================================================

set -e  # Hentikan script jika ada perintah yang gagal

echo ">>> [Deploy] Menjalankan composer install..."
composer install --no-dev --working-dir=/var/www/html

echo ">>> [Deploy] Membuat symlink storage..."
php artisan storage:link --force || true

echo ">>> [Deploy] Meng-cache konfigurasi..."
php artisan config:cache

echo ">>> [Deploy] Meng-cache routes..."
php artisan route:cache

echo ">>> [Deploy] Menjalankan migrasi database..."
php artisan migrate --force

echo ">>> [Deploy] Selesai! Aplikasi siap dijalankan."
