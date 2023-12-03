# Utiliza una imagen base de Debian
FROM debian:buster

# Instala Apache, PHP y MySQL
RUN apt-get update && \
    apt-get install -y apache2 php php-mysql mariadb-server && \
    rm -rf /var/lib/apt/lists/*

# Copia los archivos PHP al directorio del servidor web
COPY . /var/www/html/
# Copia el archivo SQL en el contenedor
COPY sql/tienda_abraham.sql /tienda_abraham.sql
RUN rm /var/www/html/index.html

# Expone el puerto 80
EXPOSE 80


# Crea un script de inicio personalizado
COPY start.sh /start.sh
RUN chmod +x /start.sh

# Inicia Apache y MySQL
CMD ["/start.sh"]