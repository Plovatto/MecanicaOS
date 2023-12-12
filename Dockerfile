FROM php:8.2-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libonig-dev \
    git \
    unzip

# Install PHP extensions
RUN docker-php-ext-install intl

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

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Change document root for Apache
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Set permissions
RUN chown -R www-data:www-data /var/www/html