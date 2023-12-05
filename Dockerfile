# Usar una imagen oficial de PHP con Apache
FROM php:7.4-apache

# Instalar extensiones de PHP necesarias para MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copiar los archivos de tu aplicación PHP al contenedor
COPY . /var/www/html/

# Exponer el puerto 80
EXPOSE 80
