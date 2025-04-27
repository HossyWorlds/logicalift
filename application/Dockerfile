FROM php:8.2-fpm-bullseye

# Install dependencies and clean up in a single RUN to reduce layers
RUN apt-get update && apt-get install -y \
    curl \
    zip \
    unzip \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    default-mysql-client \
    gnupg \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Node.js and npm
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Set up directories with proper permissions
RUN mkdir -p /var/www/logicalift/storage \
    && chown -R www-data:www-data /var/www/logicalift \
    && chmod -R 775 /var/www/logicalift/storage

WORKDIR /var/www/logicalift

COPY --chown=www-data:www-data . .
COPY php.ini /usr/local/etc/php/php.ini

# Run as non-root user
USER www-data

EXPOSE 9000

CMD ["php-fpm", "-y", "/usr/local/etc/php-fpm.conf", "-R"]
