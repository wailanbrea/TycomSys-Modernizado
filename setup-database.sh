#!/bin/bash

# Database Setup Script for Laravel Cloud
# This script sets up SQLite database and runs migrations and seeders

echo "🗄️ Setting up PostgreSQL database for Laravel Cloud..."

# Database connection will be handled by PostgreSQL
echo "📁 Using PostgreSQL database from Laravel Cloud..."

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
