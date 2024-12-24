# Usa una imagen oficial de PHP con Apache
FROM php:8.1-apache

# Copia los archivos del proyecto a la carpeta del servidor web
COPY public/ /var/www/html/

# Exponer el puerto 80 (HTTP)
EXPOSE 80

# Comando para iniciar el servidor Apache
CMD ["apache2-foreground"]
