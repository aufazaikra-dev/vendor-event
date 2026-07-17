FROM richarvey/nginx-php-fpm:latest

# Environment variables untuk konfigurasi container
ENV SKIP_COMPOSER=1 \
    WEBROOT=/var/www/html/public \
    PHP_ERRORS_STDERR=1 \
    RUN_SCRIPTS=1 \
    REAL_IP_HEADER=1 \
    APP_ENV=production \
    APP_DEBUG=false \
    LOG_CHANNEL=stderr \
    COMPOSER_ALLOW_SUPERUSER=1

# Salin semua file project ke dalam container
COPY . /var/www/html

# Set working directory
WORKDIR /var/www/html

# Pastikan script deploy bisa dieksekusi
RUN chmod +x /var/www/html/scripts/00-laravel-deploy.sh

CMD ["/start.sh"]
