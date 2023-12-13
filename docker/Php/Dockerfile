FROM php:8.1-fpm-alpine

RUN apk --update --no-cache add git postgresql-dev

RUN docker-php-ext-install pdo pdo_pgsql
