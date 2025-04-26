FROM php:8.1.0-fpm

RUN apt update && apt install -y \
    curl \
    zip \
    unzip \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev 

RUN docker-php-ext-install pdo pdo_pgsql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN mkdir -p /var/www/logicalift
RUN mkdir -p /var/www/logicalift/storage
RUN chown -R www-data:www-data /var/www/logicalift \
    && chmod -R 775 /var/www/logicalift/storage

WORKDIR /var/www/logicalift

COPY . .

COPY php.ini /usr/local/etc/php/php.ini

EXPOSE 9000

CMD ["php-fpm", "-y", "/usr/local/etc/php-fpm.conf", "-R"]
