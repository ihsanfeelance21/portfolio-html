FROM php:8.3-fpm-alpine

RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS \
    && docker-php-ext-install pdo pdo_mysql \
    && apk del .build-deps

RUN mkdir -p /var/www/html/public/uploads

COPY --chown=www-data:www-data . /var/www/html

WORKDIR /var/www/html

USER www-data

EXPOSE 9000
