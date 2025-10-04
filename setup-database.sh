#!/bin/bash

# Database Setup Script for Laravel Cloud
# This script sets up SQLite database and runs migrations and seeders

echo "🗄️ Setting up SQLite database for Laravel Cloud..."

# Create SQLite database file
echo "📁 Creating SQLite database file..."
touch /tmp/ticomsys_modernizado.sqlite

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

echo "✅ SQLite database setup completed successfully!"
