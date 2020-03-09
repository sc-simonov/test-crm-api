FROM php:7.4-fpm
RUN mkdir -p /app \
    && apt-get update && apt-get install -y git zip nano postgresql libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql
    && docker-php-ext-install pdo pdo_pgsql pgsql \
    && echo "catch_workers_output = yes" >> /usr/local/etc/php-fpm.d/www.conf \
    && echo "php_flag[display_errors] = on" >> /usr/local/etc/php-fpm.d/www.conf \
    && echo "php_admin_value[error_log] = /app/docker/php/logs/php-fpm.log" >> /usr/local/etc/php-fpm.d/www.conf \
    && echo "php_admin_flag[log_errors] = on" >> /usr/local/etc/php-fpm.d/www.conf
WORKDIR /app/crm