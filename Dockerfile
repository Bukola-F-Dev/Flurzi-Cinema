FROM php:8.3-cli

# Install system packages + PHP extensions
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev zip libpng-dev libgmp-dev libxml2-dev ftp \
    && docker-php-ext-install zip pdo pdo_mysql gd bcmath gmp ftp \
    && apt-get clean

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