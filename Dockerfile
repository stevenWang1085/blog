FROM richarvey/nginx-php-fpm:1.6.6

ENV SOURCE_ROOT /var/www/html

COPY . $SOURCE_ROOT
RUN rm -rf vendor
RUN mkdir $SOURCE_ROOT/conf
RUN mkdir $SOURCE_ROOT/script
COPY nginx-site.conf $SOURCE_ROOT/conf
COPY 00-init.sh $SOURCE_ROOT/script

WORKDIR $SOURCE_ROOT
RUN mkdir vendor \
    && chown -R nginx:nginx vendor \
    && chown -R nginx:nginx $SOURCE_ROOT/bootstrap/cache \
    && chmod +x artisan \
#    && chmod -R 777 .discovery \
    && chmod -R 777 storage/ \
    && chown nginx:nginx .env \
    && touch $SOURCE_ROOT/storage/logs/laravel.log \
    && chown nginx:nginx $SOURCE_ROOT/storage/logs/laravel.log \
    && sed -i 's@error_log /dev/stderr info;@error_log /dev/stderr debug;@' /etc/supervisord.conf \
    && sed -i "s@storage_path('logs/laravel.log')@'public/logs/'@g" config/logging.php

USER nginx
RUN composer install \
    && ./artisan key:generate

ENV WEBROOT $SOURCE_ROOT/public
ENV RUN_SCRIPTS 1
ENV SKIP_COMPOSER 1
USER root
