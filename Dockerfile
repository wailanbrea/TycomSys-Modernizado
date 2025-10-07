# Use PHP 8.2 CLI
FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpq-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nodejs \
    npm \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions (incluyendo PostgreSQL)
RUN docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files first for better caching
COPY composer.json composer.lock ./

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Copy application files
COPY . .

# Run composer scripts
RUN composer run-script post-install-cmd

# Install Node.js dependencies and build frontend
RUN cd frontend && npm install && npm run build

# Create storage directories
RUN mkdir -p storage/framework/{sessions,views,cache} \
    && mkdir -p storage/logs \
    && mkdir -p bootstrap/cache

# Set proper permissions
RUN chmod -R 775 storage bootstrap/cache

# Generate APP_KEY and run migrations
RUN php artisan key:generate --force \
    && php artisan migrate --force \
    && php artisan db:seed --force

# Expose port (Render asigna dinámicamente)
EXPOSE $PORT

# Start Laravel development server
CMD php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
