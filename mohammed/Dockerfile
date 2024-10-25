# Dockerfile for Dolibarr
FROM php:7.4-apache

# Installer les extensions PHP nécessaires pour MariaDB
RUN docker-php-ext-install mysqli

# Télécharger et installer Dolibarr
RUN apt-get update && apt-get install -y unzip wget && \
    wget https://sourceforge.net/projects/dolibarr/files/Dolibarr%20ERP-CRM/17.0.1/dolibarr-17.0.1.zip && \
    unzip dolibarr-17.0.1.zip -d /var/www/html && \
    mv /var/www/html/dolibarr-17.0.1 /var/www/html/dolibarr && \
    rm dolibarr-17.0.1.zip

# Changer les permissions
RUN chown -R www-data:www-data /var/www/html/dolibarr

# Exposer le port 80
EXPOSE 80

CMD ["apache2-foreground"]

