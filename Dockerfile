FROM richarvey/nginx-php-fpm:1.6.6

ENV SOURCE_ROOT /var/www/html

COPY . $SOURCE_ROOT
