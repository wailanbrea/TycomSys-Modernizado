#!/bin/bash
set -e

echo "🔧 Instalando dependencias de Composer..."
composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

echo "🔑 Generando APP_KEY..."
php artisan key:generate --force

echo "📦 Creando directorio de storage si no existe..."
mkdir -p storage/framework/{sessions,views,cache}
mkdir -p storage/logs
mkdir -p bootstrap/cache

echo "🔐 Configurando permisos..."
chmod -R 775 storage bootstrap/cache

echo "🗄️ Ejecutando migraciones..."
php artisan migrate --force

echo "🌱 Ejecutando seeders..."
php artisan db:seed --force

echo "🧹 Limpiando caché..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

echo "⚛️ Instalando dependencias de Node..."
cd frontend
npm install

echo "🏗️ Construyendo frontend React..."
npm run build

echo "✅ Build completado exitosamente!"


