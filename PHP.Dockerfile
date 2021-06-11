FROM php:7.4-fpm

RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN pecl install xdebug && docker-php-ext-enable xdebug

RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl