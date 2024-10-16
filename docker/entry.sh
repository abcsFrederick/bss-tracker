#!/bin/bash

php /var/www/html/artisan migrate --force

if [ ! -f /var/www/html/.bss-setup ]; then
    cd /var/www/html && composer install --prefer-dist --ignore-platform-reqs --no-dev --optimize-autoloader --no-interaction
    cd /var/www/html && npm install && npm run build
    php artisan config:cache && \
    php artisan route:cache && \
    ln -s /var/www/html/storage/app/public/ storage && \
    chmod 777 -R /var/www/html/storage/ && \
    chown -R www-data:www-data /var/www/ && \
    a2enmod rewrite
    php /var/www/html/artisan db:seed --force
    php artisan storage:link
    touch /var/www/html/.bss-setup
fi

exec "/usr/local/bin/apache2-foreground"
