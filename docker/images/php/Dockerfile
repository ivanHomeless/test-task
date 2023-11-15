FROM php:8.1.5-fpm

WORKDIR /usr/share/nginx/test

RUN apt-get update \
    && apt-get install -y \
    libmagickwand-dev \
    libmagickcore-dev \
    libzip-dev \
    libwebp-dev \
       && groupadd dev -g 1001 \
        && usermod -aG dev www-data

RUN docker-php-ext-install exif \
 && pecl install imagick \
 && docker-php-ext-enable imagick \
 && PHP_OPENSSL=yes \
 && docker-php-ext-install xml \
 && docker-php-ext-install filter \
 && docker-php-ext-install zip \
 && docker-php-ext-install bcmath \
 && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
 && docker-php-ext-install gd \
 && docker-php-ext-install -j$(nproc) mysqli pdo_mysql \
 && docker-php-ext-install intl

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ADD php.ini /usr/local/etc/php/conf.d/40-custom.ini


CMD ["php-fpm"]



