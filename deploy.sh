#!/bin/bash

# Script de deploy para Laravel Cloud
# Este script se ejecuta automáticamente durante el deploy

echo "🚀 Iniciando deploy de TICOMSYS..."

# Optimizar para producción
echo "📦 Optimizando aplicación para producción..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Ejecutar migraciones
echo "🗄️ Ejecutando migraciones..."
php artisan migrate --force

# Ejecutar seeders solo si es la primera vez
echo "🌱 Ejecutando seeders de datos de prueba..."
php artisan db:seed --force

# Crear enlace simbólico de storage
echo "🔗 Creando enlace de storage..."
php artisan storage:link

# Limpiar cache
echo "🧹 Limpiando cache..."
php artisan cache:clear
php artisan config:clear

echo "✅ Deploy completado exitosamente!"
echo "🎉 TICOMSYS está listo para usar con datos de prueba"
