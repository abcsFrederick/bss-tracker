#!/bin/bash

php /var/www/html/artisan migrate --force
php /var/www/html/artisan db:seed --force

touch /var/www/html/.bss-setup

php /var/www/html/artisan storage:link

exec "/usr/local/bin/apache2-foreground"
