# Guía de Despliegue en Vercel - TicomSys Moderno

## 📋 Pasos para Desplegar en Vercel

### 1. Preparación del Proyecto

✅ **Archivos creados:**
- `vercel.json` - Configuración principal de Vercel
- `frontend/vercel.json` - Configuración del frontend
- `vercel.env.example` - Variables de entorno de ejemplo
- `database-config-vercel.md` - Configuración de base de datos

### 2. Configuración en Vercel

#### Paso 1: Conectar Repositorio
1. Ve a [vercel.com](https://vercel.com)
2. Inicia sesión con tu cuenta de GitHub
3. Haz clic en "New Project"
4. Selecciona el repositorio `wailanbrea/ticomsys-moderno`
5. Configura el proyecto:
   - **Project Name**: `ticomsys-moderno`
   - **Framework Preset**: `Other`
   - **Root Directory**: `./`

#### Paso 2: Configurar Variables de Entorno
En la sección "Environment Variables" de Vercel, agrega:

```env
APP_NAME=TicomSys Moderno
APP_ENV=production
APP_KEY=base64:jFD66r4zXQsDK3thqmX+uGoXg6b2j3tB8FPq0l2CHns=
APP_DEBUG=false
APP_URL=https://ticomsys-moderno.vercel.app

# Base de datos (configurar según tu proveedor)
DB_CONNECTION=pgsql
DB_HOST=tu-host-postgres
DB_PORT=5432
DB_DATABASE=tu-base-datos
DB_USERNAME=tu-usuario
DB_PASSWORD=tu-contraseña

# Cache y sesiones
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync

# Email (opcional)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=tu-email@gmail.com
MAIL_PASSWORD=tu-contraseña-app
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=tu-email@gmail.com
MAIL_FROM_NAME=TicomSys Moderno

# Frontend
REACT_APP_API_URL=https://ticomsys-moderno.vercel.app/api
```

### 3. Configuración de Base de Datos

#### Opción A: Vercel Postgres (Recomendado)
1. En el dashboard de Vercel, ve a tu proyecto
2. Pestaña "Storage" → "Create Database" → "Postgres"
3. Copia las credenciales y agrégalas a las variables de entorno

#### Opción B: PlanetScale (MySQL)
1. Crea cuenta en [planetscale.com](https://planetscale.com)
2. Crea una nueva base de datos
3. Copia las credenciales de conexión

### 4. Generar APP_KEY

Antes del despliegue, genera una clave de aplicación:

```bash
php artisan key:generate --show
```

Copia la clave generada y agrégala como `APP_KEY` en las variables de entorno de Vercel.

### 5. Despliegue

1. Haz clic en "Deploy" en Vercel
2. Espera a que se complete el build
3. Verifica que la aplicación funcione correctamente

### 6. Configuración Post-Despliegue

#### Ejecutar Migraciones
Después del primer despliegue, ejecuta las migraciones:

```bash
# En la consola de Vercel o usando Vercel CLI
vercel env pull .env.local
php artisan migrate --force
php artisan db:seed --force
```

#### Configurar Storage
```bash
php artisan storage:link
```

### 7. Estructura de Rutas

El proyecto está configurado para manejar:

- **Frontend React**: `/` (todas las rutas principales)
- **API Laravel**: `/api/*`
- **Admin**: `/admin/*`
- **Técnico**: `/tecnico/*`
- **Cliente**: `/customer/*`
- **Auth**: `/auth/*`

### 8. Comandos Útiles

```bash
# Instalar Vercel CLI
npm i -g vercel

# Desplegar desde local
vercel

# Ver logs
vercel logs

# Configurar variables de entorno
vercel env add APP_KEY
```

### 9. Solución de Problemas

#### Error de PHP
- Verifica que `vercel.json` esté configurado correctamente
- Asegúrate de que las rutas de API estén bien definidas

#### Error de Base de Datos
- Verifica las credenciales de conexión
- Asegúrate de que la base de datos esté accesible desde Vercel

#### Error de Frontend
- Verifica que `frontend/package.json` tenga el script `vercel-build`
- Asegúrate de que el build de React se complete correctamente

### 10. Monitoreo

- Usa el dashboard de Vercel para monitorear el rendimiento
- Revisa los logs en caso de errores
- Configura alertas para errores críticos

## 🚀 ¡Listo para Desplegar!

Tu proyecto está configurado para Vercel. Solo necesitas:

1. ✅ Conectar el repositorio
2. ✅ Configurar las variables de entorno
3. ✅ Configurar la base de datos
4. ✅ Hacer el despliegue

**URL del proyecto**: `https://ticomsys-moderno.vercel.app`
