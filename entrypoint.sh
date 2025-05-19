#!/bin/bash

# Ajusta permissões dos diretórios importantes
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Executa o comando que foi passado no docker-compose (ex: php-fpm)
exec "$@"
