FROM php:8.2.23-apache

ARG DEBIAN_FRONTEND=noninteractive

# Instalar extensiones de PHP necesarias
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip \
    unzip \
    git

# Include  DB driver
RUN docker-php-ext-install pdo
RUN docker-php-ext-install pdo_mysql

RUN a2enmod rewrite

# Instalar Xdebug
RUN pecl install xdebug-3.3.2
RUN docker-php-ext-enable xdebug

ADD xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html