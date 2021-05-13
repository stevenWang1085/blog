# https://gitlab.com/ric_harvey/nginx-php-fpm/blob/master/docs/repo_layout.md
FROM richarvey/nginx-php-fpm:1.6.6

ENV SOURCE_ROOT /var/www/html

COPY . $SOURCE_ROOT
COPY cloudbuild/.env $SOURCE_ROOT/.env
COPY cloudbuild/conf/ $SOURCE_ROOT/conf
COPY cloudbuild/scripts $SOURCE_ROOT/scripts


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
#    && crontab -l | { cat; echo "* * * * * /usr/local/bin/php /var/www/html/artisan schedule:run >> /dev/null 2>&1"; } | crontab - \
#    && ["/usr/sbin/crond", "-f", "-d", "0"]

#CMD ["/usr/sbin/crond", "-f", "-d", "0"]

#USER nginx
#RUN composer install
#RUN ./artisan key:generate
#RUN ./artisan migrate

ENV WEBROOT $SOURCE_ROOT/public
ENV RUN_SCRIPTS 1
ENV SKIP_COMPOSER 1
USER root
