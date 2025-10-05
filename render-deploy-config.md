# Configuración de Variables de Entorno para Render

## 🔧 Variables de Entorno en Render Dashboard

### Variables del Sistema:
```env
APP_ENV=production
APP_DEBUG=false
LOG_LEVEL=error
```

### Variables de Base de Datos (Auto-configuradas por Render):
```env
DB_CONNECTION=pgsql
DB_HOST=${{ticomsys-db.host}}
DB_PORT=${{ticomsys-db.port}}
DB_DATABASE=${{ticomsys-db.database}}
DB_USERNAME=${{ticomsys-db.user}}
DB_PASSWORD=${{ticomsys-db.password}}
```

### Variables de Cache y Sesión:
```env
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
```

## 📋 Pasos para Configurar en Render

### 1. Crear Web Service
- **Name**: `ticomsys-complete`
- **Environment**: `PHP`
- **Build Command**: `composer install --no-dev --optimize-autoloader && php artisan key:generate --force && cd frontend && npm install && npm run build`
- **Start Command**: `php artisan serve --host=0.0.0.0 --port=$PORT`

### 2. Crear PostgreSQL Database
- **Name**: `ticomsys-db`
- **Database**: `ticomsys`
- **User**: `ticomsys_user`

### 3. Configurar Variables de Entorno
En el Web Service, ir a **Environment** y agregar:

```env
APP_ENV=production
APP_DEBUG=false
LOG_LEVEL=error
DB_CONNECTION=pgsql
DB_HOST=${{ticomsys-db.host}}
DB_PORT=${{ticomsys-db.port}}
DB_DATABASE=${{ticomsys-db.database}}
DB_USERNAME=${{ticomsys-db.user}}
DB_PASSWORD=${{ticomsys-db.password}}
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
```

### 4. Ejecutar Comandos de Setup
En **Shell** del Web Service:
```bash
php artisan migrate --force
php artisan db:seed --force
```

## 🚀 Resultado Final

**URL única para todo:**
- **Aplicación**: `https://ticomsys-complete.onrender.com`
- **API**: `https://ticomsys-complete.onrender.com/api`
- **Login**: `https://ticomsys-complete.onrender.com/ticomsyslogin`
- **Dashboard**: `https://ticomsys-complete.onrender.com/admin`

## 💰 Costo: $0/mes (Plan Gratuito)
