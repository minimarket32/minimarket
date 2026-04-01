FROM php:8.2-cli

# Instalar dependencias necesarias
RUN apt-get update && apt-get install -y \
    git unzip curl libpq-dev zip \
    && docker-php-ext-install pdo pdo_pgsql

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar proyecto
WORKDIR /app
COPY . .

# Instalar Laravel dependencias
RUN composer install --no-dev --optimize-autoloader

# Exponer puerto requerido por Render
EXPOSE 10000

# Ejecutar migraciones y arrancar servidor
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=10000