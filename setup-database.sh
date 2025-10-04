#!/bin/bash

# Database Setup Script for Laravel Cloud
# This script waits for database connection and then runs migrations and seeders

echo "🗄️ Setting up database for Laravel Cloud..."

# Wait for database connection
echo "⏳ Waiting for database connection..."
until php artisan tinker --execute="DB::connection()->getPdo();" 2>/dev/null; do
    echo "Database not ready, waiting..."
    sleep 2
done

echo "✅ Database connection established!"

# Run migrations
echo "🔄 Running database migrations..."
php artisan migrate --force

# Run seeders
echo "🌱 Running database seeders..."
php artisan db:seed --force

# Cache configuration
echo "⚡ Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Database setup completed successfully!"
