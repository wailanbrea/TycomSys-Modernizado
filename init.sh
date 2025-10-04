#!/bin/bash

# Laravel Cloud Initialization Script
# This script initializes the Laravel application for Laravel Cloud

echo "🚀 Initializing Laravel Cloud deployment..."

# Set working directory
cd /var/www/html

# Copy environment configuration
echo "📝 Setting up environment configuration..."
if [ -f "laravel-cloud-env.txt" ]; then
    cp laravel-cloud-env.txt .env
    echo "✅ Environment file copied from laravel-cloud-env.txt"
elif [ -f "laravel-cloud.env" ]; then
    cp laravel-cloud.env .env
    echo "✅ Environment file copied from laravel-cloud.env"
else
    echo "⚠️ No environment file found, using default"
fi

# Create SQLite database
echo "🗄️ Creating SQLite database..."
touch /tmp/database.sqlite
chmod 666 /tmp/database.sqlite

# Generate application key
echo "🔑 Generating application key..."
php artisan key:generate --force

# Set proper permissions
echo "🔐 Setting file permissions..."
chmod -R 755 storage bootstrap/cache
chmod -R 755 public

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
echo "🌐 Application should be accessible at: https://tycomsys-modernizado-main-xaiitl.laravel.cloud"
