FROM php:8.2-apache

# Habilitar mod_rewrite (por si usas rutas/htaccess)
RUN a2enmod rewrite

# Instalar extensiones necesarias para MySQL (PDO)
RUN docker-php-ext-install pdo pdo_mysql

# Cambiar DocumentRoot a /public
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf \
 && sed -ri 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copiar el proyecto al contenedor
COPY . /var/www/html/

# Permisos (en general no hace falta, pero ayuda)
RUN chown -R www-data:www-data /var/www/html
