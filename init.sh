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

# Database connection will be handled by PostgreSQL
echo "🗄️ Using PostgreSQL database from Laravel Cloud..."

# Generate application key
echo "🔑 Generating application key..."
php artisan key:generate --force

# Set proper permissions
echo "🔐 Setting file permissions..."
chmod -R 755 storage bootstrap/cache
chmod -R 755 public
chmod -R 755 /var/www/html

# Ensure public directory exists and is accessible
echo "📁 Ensuring public directory structure..."
mkdir -p /var/www/html/public
touch /var/www/html/public/index.php
chmod 644 /var/www/html/public/index.php
chmod 755 /var/www/html/public

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
echo "🌐 Application should be accessible at: https://tycomsys-modernizado-main-xaiitl.laravel.cloud"
