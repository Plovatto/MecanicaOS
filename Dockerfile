FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    libicu-dev \
    libonig-dev \
    nginx

COPY . /var/www/html/

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install intl mbstring mysqli pdo pdo_mysql

RUN chown -R www-data:www-data /var/www/html

WORKDIR /var/www/html/

RUN composer install --no-interaction -vvv

RUN rm /etc/nginx/sites-enabled/default

COPY ./nginx.conf /etc/nginx/sites-enabled/
WORKDIR /var/www/html/public

CMD service nginx start && php-fpm