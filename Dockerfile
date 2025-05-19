FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    zip unzip curl git libpng-dev libonig-dev libxml2-dev libzip-dev nano sudo \
    libcurl4-openssl-dev pkg-config libssl-dev libonig-dev \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath xml curl

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

WORKDIR /var/www

USER www-data

# Copia o script para dentro da imagem
COPY entrypoint.sh /usr/local/bin/entrypoint.sh

# Dá permissão de execução
USER root
RUN chmod +x /usr/local/bin/entrypoint.sh
USER www-data

# Define o script como entrypoint
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]

# Mantém o comando padrão
CMD ["php-fpm"]
