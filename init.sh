#!/bin/bash

echo "🚀 Initializing Laravel Cloud deployment..."

# Set working directory
cd /var/www/html

# Copy environment configuration
echo "📝 Setting up environment configuration..."
if [ -f "laravel-cloud-env.txt" ]; then
    cp laravel-cloud-env.txt .env
    echo "✅ Environment file copied from laravel-cloud-env.txt"
else
    echo "⚠️ No environment file found, using default"
fi

# Generate application key
echo "🔑 Generating application key..."
php artisan key:generate --force

# Set proper permissions
echo "🔐 Setting file permissions..."
chmod -R 755 storage bootstrap/cache
chmod -R 755 public

# Install Composer dependencies
echo "📦 Installing Composer dependencies..."
composer install --optimize-autoloader --no-dev

# Build frontend assets
echo "🎨 Building frontend assets..."
cd /var/www/html/frontend
npm install
npm run build
cd /var/www/html

# Clear and cache configuration
echo "⚡ Optimizing application..."
php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run database migrations
echo "🔄 Running database migrations..."
php artisan migrate --force

# Run database seeders
echo "🌱 Running database seeders..."
php artisan db:seed --force

echo "✅ Laravel Cloud initialization completed successfully!"