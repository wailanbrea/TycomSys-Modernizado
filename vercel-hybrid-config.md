# Configuración Híbrida para TicomSys en Vercel

## 🎯 Estrategia Híbrida

### Frontend (Vercel)
- React App desplegado en Vercel
- Interfaz de usuario completa
- Navegación y UI/UX

### Backend (Servicio separado)
- Laravel API en Railway/Render/Heroku
- Base de datos PostgreSQL en la nube
- Autenticación y lógica de negocio

## 📋 Pasos de Implementación

### 1. Desplegar Backend Laravel
```bash
# Opciones de hosting para Laravel:
- Railway.app (Recomendado)
- Render.com
- Heroku
- DigitalOcean App Platform
```

### 2. Configurar Base de Datos
```bash
# Opciones de base de datos:
- Railway PostgreSQL
- Supabase
- PlanetScale
- Neon
```

### 3. Variables de Entorno en Vercel
```env
# En Vercel Dashboard > Settings > Environment Variables
REACT_APP_API_URL=https://tu-backend.railway.app/api
REACT_APP_BASE_URL=https://tu-backend.railway.app
REACT_APP_ENV=production
```

### 4. Actualizar Configuración de Vercel
```json
{
  "version": 2,
  "name": "ticomsys-moder",
  "buildCommand": "npm run build",
  "outputDirectory": "build",
  "env": {
    "REACT_APP_API_URL": "https://tu-backend.railway.app/api",
    "REACT_APP_BASE_URL": "https://tu-backend.railway.app"
  }
}
```

## 🔧 Configuración del Frontend

### Actualizar API URLs
```javascript
// En todos los archivos que usan fetch
const API_BASE_URL = process.env.REACT_APP_API_URL || 'http://localhost:8000/api';

// Ejemplo de uso:
const response = await fetch(`${API_BASE_URL}/repair-equipment`);
```

### Configurar CORS en Laravel
```php
// config/cors.php
'paths' => ['api/*', 'sanctum/csrf-cookie'],
'allowed_methods' => ['*'],
'allowed_origins' => [
    'https://ticomsys-moder.vercel.app',
    'http://localhost:3000'
],
'allowed_origins_patterns' => [],
'allowed_headers' => ['*'],
'exposed_headers' => [],
'max_age' => 0,
'supports_credentials' => true,
```

## 🚀 Pasos de Despliegue

### 1. Preparar Backend
```bash
# Crear archivo railway.json
{
  "build": {
    "builder": "NIXPACKS"
  },
  "deploy": {
    "startCommand": "php artisan serve --host=0.0.0.0 --port=$PORT",
    "healthcheckPath": "/api/health"
  }
}
```

### 2. Desplegar en Railway
```bash
# Instalar Railway CLI
npm install -g @railway/cli

# Login y deploy
railway login
railway init
railway up
```

### 3. Configurar Variables en Railway
```env
APP_ENV=production
APP_KEY=base64:tu-app-key
DB_CONNECTION=pgsql
DB_HOST=tu-postgres-host
DB_PORT=5432
DB_DATABASE=tu-database
DB_USERNAME=tu-username
DB_PASSWORD=tu-password
```

### 4. Actualizar Vercel
```bash
# Actualizar vercel.json con nueva API URL
# Configurar variables de entorno en Vercel Dashboard
# Hacer redeploy
```

## 💰 Costos Estimados

### Railway (Backend)
- Plan Hobby: $5/mes
- PostgreSQL: Incluido

### Vercel (Frontend)
- Plan Hobby: Gratis
- Dominio personalizado: $15/año

### Total: ~$5/mes + dominio

## 🔄 Flujo de Datos

```
Usuario → Vercel (React) → Railway (Laravel API) → PostgreSQL
```

## 📱 URLs Finales

- Frontend: https://ticomsys-moder.vercel.app
- Backend API: https://ticomsys-backend.railway.app
- Base de datos: PostgreSQL en Railway
