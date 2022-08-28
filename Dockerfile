FROM php:7.3-fpm

ENV COMPOSER_VERSION 2.3.3

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=$COMPOSER_VERSION

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        libzip-dev \
        unzip \
        git \
        zip \
    && apt-get clean \
    && docker-php-ext-install \
        mysqli \
        pdo_mysql \
        zip \
    && docker-php-ext-enable pdo_mysql \
    && rm -rf /var/lib/apt/lists/*;