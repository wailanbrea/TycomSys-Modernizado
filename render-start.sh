#!/bin/bash
set -e

echo "🚀 Iniciando aplicación Laravel..."

# Verificar que storage tenga permisos
chmod -R 775 storage bootstrap/cache 2>/dev/null || true

# Limpiar cachés antes de iniciar
php artisan config:cache
php artisan route:cache

# Iniciar servidor
php artisan serve --host=0.0.0.0 --port=${PORT:-8000}


