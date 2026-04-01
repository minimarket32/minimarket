FROM php:8.2-cli

# Instalar dependencias
RUN apt-get update && apt-get install -y \
    git unzip curl libpq-dev zip \
    && docker-php-ext-install pdo pdo_pgsql

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar proyecto
WORKDIR /app
COPY . .

# Instalar Laravel
RUN composer install --no-dev --optimize-autoloader

# Generar key y optimizar
RUN php artisan key:generate

# Exponer puerto
EXPOSE 10000

# Comando de inicio
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=10000