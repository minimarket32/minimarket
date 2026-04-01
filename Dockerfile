FROM php:8.2-cli

# 1. Instalar dependencias del sistema y drivers de PostgreSQL
RUN apt-get update && apt-get install -y \
    git unzip curl libpq-dev zip postgresql-client \
    && docker-php-ext-install pdo pdo_pgsql

# 2. Instalar Composer desde la imagen oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 3. Configurar directorio de trabajo y copiar archivos
WORKDIR /app
COPY . .

# 4. Instalar dependencias de PHP (Laravel)
RUN composer install --no-dev --optimize-autoloader

# 5. Limpiar caches para evitar errores de rutas o config vieja
RUN php artisan config:clear || true
RUN php artisan cache:clear || true
RUN php artisan route:clear || true

# 6. Dar permisos a la carpeta de almacenamiento (Vital para evitar Error 500)
RUN chmod -R 775 storage bootstrap/cache

# 7. Exponer el puerto que usa Render
EXPOSE 10000

# 8. IMPORTAR BASE Y ARRANCAR
# Explicación: 
# - 'psql $DATABASE_URL' se conecta a Render.
# - '-f database/minimarket.sql' ejecuta tu archivo convertido.
# - '|| true' evita que el despliegue falle si las tablas ya existen.
CMD psql $DATABASE_URL -f database/minimarket.sql || true && php artisan serve --host=0.0.0.0 --port=10000
