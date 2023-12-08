FROM php:8.2-fpm
COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY composer.json composer.json

RUN apt-get update && apt-get install -y \
    libicu-dev \
    libonig-dev \
    nginx \
    git \
    unzip

RUN composer validate --strict
RUN composer install --no-scripts --ignore-platform-reqs --no-dev

COPY . /var/www/html/

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install intl mbstring mysqli pdo pdo_mysql

RUN chown -R www-data:www-data /var/www/html

RUN rm /etc/nginx/sites-enabled/default

COPY ./nginx.conf /etc/nginx/sites-available/default
RUN ln -s /etc/nginx/sites-available/default /etc/nginx/sites-enabled/

WORKDIR /var/www/html/public
EXPOSE 80 443

CMD service php8.2-fpm start && nginx -g 'daemon off;'
