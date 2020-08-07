FROM php:7-fpm-alpine

WORKDIR /var/www/html

COPY ./backend /var/www/html

VOLUME backend:/var/www/html

RUN apk --update add wget \
  curl \
  git \
  libmemcached-dev \
  && docker-php-ext-install pdo pdo_mysql \
  && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
  && php /usr/local/bin/composer install \
  && rm /var/cache/apk/* \
  && php artisan migrate:refresh --seed

EXPOSE 8000

CMD php artisan serve --host=0.0.0.0 --port=8000