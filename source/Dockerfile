# Use official PHP image from Docker Hub
FROM php:8.0-apache

# Install necessary PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Set working directory
WORKDIR /var/www/html

# Copy all PHP files into the container
COPY . .

# Expose the HTTP port (default is 80)
EXPOSE 80

# Set the entry point for the app (Apache in this case)
CMD ["apache2-foreground"]
