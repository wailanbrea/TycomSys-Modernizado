#!/bin/bash

# Laravel Cloud Deployment Script
# This script sets up the environment for Laravel Cloud deployment

echo "🚀 Starting Laravel Cloud deployment setup..."

# Copy environment file
echo "📝 Setting up environment configuration..."
cp laravel-cloud.env .env

# Generate application key if not exists
echo "🔑 Generating application key..."
php artisan key:generate --force

# Clear and cache configuration
echo "⚡ Optimizing application..."
php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run database migrations
echo "🗄️ Running database migrations..."
php artisan migrate --force

# Run database seeders
echo "🌱 Running database seeders..."
php artisan db:seed --force

# Set proper permissions
echo "🔐 Setting file permissions..."
chmod -R 755 storage bootstrap/cache

echo "✅ Laravel Cloud deployment setup completed!"
echo "🌐 Application should be accessible at: https://tycomsys-modernizado-main-xaiitl.laravel.cloud"
