# Use the official PHP image with Apache
FROM php:8.1-apache

# Install necessary dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    && docker-php-ext-configure gd \
    && docker-php-ext-install pdo_mysql mbstring zip gd

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set the working directory
WORKDIR /var/www/html

# Copy all project files to the container
COPY . /var/www/html

# Set permissions for storage and cache
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Expose port 80
EXPOSE 80

# Start the server
CMD ["apache2-foreground"]
