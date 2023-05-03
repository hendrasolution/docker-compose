# Use an official PHP runtime as a parent image
FROM php:7.4-apache

# Set the working directory to /var/www/html
WORKDIR /home/codingstudio/Project/testdocker

# Copy the current directory contents into the container at /var/www/html
COPY . /var/www/html

# Install any needed packages
RUN apt-get update && \
    apt-get install -y \
        git \
        zip \
        unzip && \
    rm -rf /var/lib/apt/lists/*

# Install any needed PHP extensions
RUN docker-php-ext-install pdo_mysql

# Enable Apache modules
RUN a2enmod rewrite

# Set up Apache environment variables
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
ENV APACHE_LOG_DIR /var/log/apache2

# Configure Apache virtual host
#COPY docker/vhost.conf /etc/apache2/sites-available/000-default.conf

# Expose port 80 for Apache
EXPOSE 80
