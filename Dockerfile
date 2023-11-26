FROM php:8.2-apache
# Install PDO MySQL extension
RUN docker-php-ext-install pdo_mysql
COPY src/ /var/www/html/
EXPOSE 80