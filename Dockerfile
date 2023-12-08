FROM php:8.2-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libonig-dev \
    git \
    unzip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files
COPY composer.json composer.lock ./

# Install dependencies
RUN composer install --no-scripts --ignore-platform-reqs --no-dev

# Copy application files
COPY . .

# Set permissions
RUN chown -R www-data:www-data /var/www/html
