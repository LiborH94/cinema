FROM php:8.4-fpm

WORKDIR /var/www

# system deps
RUN apt-get update && apt-get install -y \
    git unzip zip curl libsqlite3-dev libonig-dev libxml2-dev

RUN docker-php-ext-install pdo pdo_sqlite

# composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 👇 TOTO JE KLÍČ
COPY . .

# install až PO COPY
RUN composer install --no-dev --optimize-autoloader

EXPOSE 9000

RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
CMD ["php-fpm"]
