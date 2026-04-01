FROM wordpress:6.7-php8.2-apache

# Install additional PHP extensions
RUN docker-php-ext-install \
    exif \
    pcntl \
    shmop \
    sysvsem \
    sysvshm

# Install WP-CLI
RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar \
    && chmod +x wp-cli.phar \
    && mv wp-cli.phar /usr/local/bin/wp

# Install useful tools
RUN apt-get update && apt-get install -y \
    nano \
    vim \
    less \
    git \
    zip \
    unzip \
    && rm -rf /var/lib/apt/lists/*

#  Copy full WordPress project (VERY IMPORTANT)
COPY ./app/public /var/www/html

# Fix permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html
    
# Set working directory
WORKDIR /var/www/html

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
