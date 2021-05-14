FROM richarvey/nginx-php-fpm:1.6.6

ENV SOURCE_ROOT /var/www/html

COPY . $SOURCE_ROOT
COPY nginx-site.conf $SOURCE_ROOT/conf
