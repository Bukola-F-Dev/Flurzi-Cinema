FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev zip libpng-dev libxml2-dev libpq-dev \
    && docker-php-ext-install zip pdo pdo_mysql pdo_pgsql pgsql gd bcmath

# Set working directory
WORKDIR /var/www

# Copy project files
COPY . .

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Fix permissions
RUN mkdir -p storage/framework/views \
    storage/framework/cache \
    storage/framework/sessions \
    bootstrap/cache && chmod -R 777 storage bootstrap/cache

# Expose port
EXPOSE 8080

# Start Laravel app
CMD php -S 0.0.0.0:$PORT -t public