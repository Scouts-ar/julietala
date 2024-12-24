# Usa una imagen oficial de PHP con Apache
FROM php:8.1-apache

# Copia los archivos del proyecto a la carpeta del servidor web
COPY public/ /var/www/html/

# Exponer el puerto 8080 (Render lo detecta por defecto)
EXPOSE 8080

# Configura Apache para usar el puerto 8080
RUN sed -i 's/80/8080/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

# Iniciar Apache
CMD ["apache2-foreground"]
