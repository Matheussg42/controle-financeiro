FROM php:7.4-fpm

WORKDIR /var/www/html

COPY ./backend /var/www/html

# Install dependencies
RUN apt-get update && apt-get install -y \
    zip \
    vim \
    unzip \
    git \
    curl \
    openssl 

RUN docker-php-ext-install pdo pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN php /usr/local/bin/composer install

VOLUME backend:/var/www/html

RUN php artisan migrate:refresh --seed

EXPOSE 8000

CMD php artisan serve --host=0.0.0.0 --port=8000