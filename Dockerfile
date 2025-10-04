FROM heroku/heroku:22

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Set proper permissions
RUN chmod -R 755 storage bootstrap/cache

# Create public directory if it doesn't exist
RUN mkdir -p public

# Set document root
ENV DOCUMENT_ROOT=/var/www/html/public

# Expose port
EXPOSE 8080

# Start web server
CMD ["vendor/bin/heroku-php-nginx"]
