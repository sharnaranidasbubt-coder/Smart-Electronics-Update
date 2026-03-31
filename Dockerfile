FROM wordpress:6.7-php8.2-fpm

# Set working directory
WORKDIR /var/www/html

# Copy WordPress application files
COPY ./app/public /var/www/html

# Copy custom PHP configuration if exists
COPY ./conf/php/php.ini /usr/local/etc/php/conf.d/custom.ini

# Set permissions
RUN chown -R www-data:www-data /var/www/html

# Expose port 9000 for PHP-FPM
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
