#!/bin/bash

# Iniciar servicio MySQL
service mysql start

# Configurar MySQL
mysql -e "ALTER USER 'root'@'localhost' IDENTIFIED BY 'Abrah@M917'; FLUSH PRIVILEGES;"

# Importar el archivo SQL a la base de datos
mysql -u root -pAbrah@M917 < /tienda_abraham.sql

# Mantener Apache en primer plano
apache2ctl -D FOREGROUND
