# Dockerfile
FROM php:8.2-apache

# Apache modüllerini aktif et
RUN a2enmod rewrite

# PHP uzantılarını kur
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Çalışma dizinini ayarla
WORKDIR /var/www/html

# Projeyi kopyala
COPY . /var/www/html/

# İzinleri ayarla
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Port 80'i aç
EXPOSE 80

# Apache'yi başlat
CMD ["apache2-foreground"]
