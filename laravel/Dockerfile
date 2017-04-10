FROM php:7.1.1-fpm-alpine

RUN docker-php-ext-install \
    pdo_mysql \
    mysqli \
    mbstring

RUN curl -sS https://getcomposer.org/installer | \
    php -- --install-dir=/usr/bin/ --filename=composer

ENV LARAVEL_ROOT /laravel
RUN mkdir -p $LARAVEL_ROOT
WORKDIR $LARAVEL_ROOT

COPY . .

RUN chmod -R 777 storage bootstrap/cache


