# Despliegue Completo en Render.com - Todo en Uno

## 🎯 Configuración Todo en Render

### ✅ Ventajas:
- **Un solo despliegue** para frontend + backend
- **Una sola URL** para todo
- **100% gratuito** (Plan Hobby)
- **PostgreSQL incluido**
- **SSL automático**

## 📋 Pasos de Despliegue

### 1. Preparar el Proyecto
```bash
# El proyecto ya está configurado con:
# - render.yaml (configuración de Render)
# - Rutas actualizadas para servir React
# - Build del frontend incluido
```

### 2. Conectar GitHub a Render
1. Ir a [render.com](https://render.com)
2. Crear cuenta o iniciar sesión
3. Conectar con GitHub
4. Seleccionar el repositorio `ticomsys-moder`

### 3. Crear Web Service
1. **New** → **Web Service**
2. **Connect GitHub** → Seleccionar repositorio
3. **Configuración automática**:
   - **Name**: `ticomsys-complete`
   - **Environment**: `PHP`
   - **Build Command**: `composer install --no-dev --optimize-autoloader && php artisan key:generate --force && cd frontend && npm install && npm run build`
   - **Start Command**: `php artisan serve --host=0.0.0.0 --port=$PORT`

### 4. Configurar Variables de Entorno
```env
APP_ENV=production
APP_DEBUG=false
LOG_LEVEL=error
DB_CONNECTION=pgsql
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
```

### 5. Crear Base de Datos PostgreSQL
1. **New** → **PostgreSQL**
2. **Name**: `ticomsys-db`
3. **Database**: `ticomsys`
4. **User**: `ticomsys_user`

### 6. Conectar Base de Datos
En el Web Service, agregar variables:
```env
DB_HOST=${{ticomsys-db.host}}
DB_PORT=${{ticomsys-db.port}}
DB_DATABASE=${{ticomsys-db.database}}
DB_USERNAME=${{ticomsys-db.user}}
DB_PASSWORD=${{ticomsys-db.password}}
```

### 7. Ejecutar Migraciones y Seeders
```bash
# En Render Dashboard → Shell
php artisan migrate --force
php artisan db:seed --force
```

## 🌐 URLs Finales

### Una sola URL para todo:
- **Página Principal**: `https://ticomsys-complete.onrender.com/`
- **Login**: `https://ticomsys-complete.onrender.com/ticomsyslogin`
- **Dashboard**: `https://ticomsys-complete.onrender.com/admin`
- **API**: `https://ticomsys-complete.onrender.com/api/health`

## 🔧 Configuración de CORS

### Actualizar config/cors.php:
```php
return [
    'paths' => ['api/*', 'sanctum/csrf-cookie'],
    'allowed_methods' => ['*'],
    'allowed_origins' => [
        'https://ticomsys-complete.onrender.com',
        'http://localhost:3000'
    ],
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true,
];
```

## 📱 Flujo de Datos
```
Usuario → Render (Laravel + React + PostgreSQL)
```

## 💰 Costo: $0/mes

## ⚡ Características del Plan Gratuito
- **750 horas/mes** (suficiente para uso normal)
- **512MB RAM**
- **1GB PostgreSQL**
- **Sleep después de 15 min** de inactividad
- **Wake up en 30 segundos**

## 🚀 Pasos Finales

1. **Desplegar en Render**
2. **Configurar base de datos**
3. **Ejecutar migraciones**
4. **Probar la aplicación**
5. **Configurar dominio personalizado** (opcional)

## 📋 Checklist de Despliegue

- [ ] Cuenta en Render creada
- [ ] Repositorio conectado
- [ ] Web Service creado
- [ ] PostgreSQL creado
- [ ] Variables de entorno configuradas
- [ ] Migraciones ejecutadas
- [ ] Seeders ejecutados
- [ ] Aplicación funcionando
- [ ] API endpoints probados
- [ ] Frontend React funcionando

## 🎉 ¡Resultado Final!

**Una sola URL con todo funcionando:**
- ✅ Página principal con hero y animaciones
- ✅ Login de empleados
- ✅ Dashboard React completo
- ✅ API Laravel funcionando
- ✅ Base de datos con datos de prueba
- ✅ 100% gratuito
