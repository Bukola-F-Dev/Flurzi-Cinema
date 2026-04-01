FROM php:8.2-cli

# System packages + PHP extensions Laravel needs
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev zip libpng-dev \
    && docker-php-ext-install zip pdo pdo_mysql gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy project
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Laravel writable dirs
RUN chmod -R 777 storage bootstrap/cache || true

EXPOSE 8080

CMD php artisan serve --host=0.0.0.0 --port=8080