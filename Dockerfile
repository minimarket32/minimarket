FROM php:8.2-cli

# Instalar dependencias necesarias
RUN apt-get update && apt-get install -y \
    git unzip curl libpq-dev zip postgresql-client \
    && docker-php-ext-install pdo pdo_pgsql

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar proyecto
WORKDIR /app
COPY . .

# Instalar dependencias Laravel
RUN composer install --no-dev --optimize-autoloader

# Limpiar caches Laravel (evita error 500)
RUN php artisan config:clear || true
RUN php artisan cache:clear || true
RUN php artisan route:clear || true

# Exponer puerto requerido por Render
EXPOSE 10000

# Iniciar servidor Laravel (SIN migraciones)
CMD php artisan serve --host=0.0.0.0 --port=10000