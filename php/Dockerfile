FROM php:8.2-fpm-alpine

RUN docker-php-ext-install pdo pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


WORKDIR /var/www/symfo
#ENV PHP_OPEN_BASEDIR=/var/www/symfo