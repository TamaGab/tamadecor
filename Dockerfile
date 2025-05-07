FROM php:8.2-fpm

# Instalar dependências
RUN apt-get update && apt-get install -y \
    git zip unzip curl libzip-dev libpng-dev libjpeg-dev libfreetype6-dev libonig-dev libxml2-dev

# Instalar extensões PHP
RUN docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl

# Instalar o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

# Permissões
RUN chown -R www-data:www-data /var/www

CMD php artisan serve --host=0.0.0.0 --port=8000

