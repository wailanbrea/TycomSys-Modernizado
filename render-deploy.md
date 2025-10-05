# Despliegue Completo en Render.com (100% Gratuito)

## 🎯 ¿Por qué Render.com?

- ✅ **Soporta Laravel** nativamente
- ✅ **PostgreSQL gratuito** incluido
- ✅ **Un solo despliegue** para todo
- ✅ **Plan gratuito** generoso
- ✅ **SSL automático**
- ✅ **Dominio personalizado**

## 📋 Pasos para Desplegar en Render

### 1. Preparar el Proyecto
```bash
# Crear archivo render.yaml
# Configurar variables de entorno
# Preparar base de datos
```

### 2. Crear render.yaml
```yaml
services:
  - type: web
    name: ticomsys-backend
    env: php
    buildCommand: composer install --no-dev --optimize-autoloader
    startCommand: php artisan serve --host=0.0.0.0 --port=$PORT
    envVars:
      - key: APP_ENV
        value: production
      - key: APP_DEBUG
        value: false
      - key: DB_CONNECTION
        value: pgsql
      - key: DB_HOST
        fromDatabase:
          name: ticomsys-db
          property: host
      - key: DB_PORT
        fromDatabase:
          name: ticomsys-db
          property: port
      - key: DB_DATABASE
        fromDatabase:
          name: ticomsys-db
          property: database
      - key: DB_USERNAME
        fromDatabase:
          name: ticomsys-db
          property: user
      - key: DB_PASSWORD
        fromDatabase:
          name: ticomsys-db
          property: password

databases:
  - name: ticomsys-db
    databaseName: ticomsys
    user: ticomsys_user
```

### 3. Configurar Frontend para Render
```javascript
// Actualizar API URLs para apuntar a Render
const API_BASE_URL = process.env.REACT_APP_API_URL || 'https://ticomsys-backend.onrender.com/api';
```

### 4. Desplegar en Render
```bash
# Conectar GitHub a Render
# Configurar auto-deploy
# Ejecutar migraciones
# Ejecutar seeders
```

## 🆓 Plan Gratuito de Render

### Web Service (Backend)
- **750 horas/mes** (suficiente para uso normal)
- **512MB RAM**
- **Sleep después de 15 min** de inactividad
- **Wake up automático** en 30 segundos

### PostgreSQL Database
- **1GB storage**
- **Sin límite de conexiones**
- **Backup automático**

## 🔄 Flujo de Datos (Todo en Render)
```
Usuario → Render (Laravel + React) → PostgreSQL (Render)
```

## 📱 URLs Finales
- **Aplicación completa**: `https://ticomsys-backend.onrender.com`
- **API**: `https://ticomsys-backend.onrender.com/api`
- **Frontend**: `https://ticomsys-backend.onrender.com` (servido por Laravel)

## 💰 Costo: $0/mes

## ⚡ Ventajas vs Vercel + Railway
- ✅ **Un solo despliegue**
- ✅ **Un solo dominio**
- ✅ **Configuración más simple**
- ✅ **100% gratuito**
- ✅ **Soporte nativo de Laravel**

## ⚠️ Limitaciones del Plan Gratuito
- **Sleep mode**: Se duerme después de 15 min de inactividad
- **Wake up time**: 30 segundos para despertar
- **RAM limitada**: 512MB (suficiente para la mayoría de apps)

## 🚀 ¿Quieres que configuremos Render.com?
