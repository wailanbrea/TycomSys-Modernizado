# Configuración de Base de Datos para Vercel

## Opciones de Base de Datos para Vercel

### 1. PostgreSQL (Recomendado)
Vercel recomienda usar PostgreSQL para aplicaciones Laravel.

**Servicios recomendados:**
- **Vercel Postgres** (integrado con Vercel)
- **PlanetScale** (MySQL compatible)
- **Supabase** (PostgreSQL)
- **Railway** (PostgreSQL)

### 2. Configuración con Vercel Postgres

1. En el dashboard de Vercel, ve a tu proyecto
2. Ve a la pestaña "Storage"
3. Crea una nueva base de datos PostgreSQL
4. Copia las credenciales de conexión

### 3. Variables de entorno necesarias

```env
DB_CONNECTION=pgsql
DB_HOST=your-postgres-host
DB_PORT=5432
DB_DATABASE=your-database-name
DB_USERNAME=your-username
DB_PASSWORD=your-password
```

### 4. Migración de SQLite a PostgreSQL

Si actualmente usas SQLite, necesitarás:

1. Exportar los datos de SQLite
2. Importar a PostgreSQL
3. Actualizar las migraciones si es necesario

### 5. Comandos de migración para Vercel

```bash
# En el build de Vercel
php artisan migrate --force
php artisan db:seed --force
```

## Configuración alternativa: PlanetScale (MySQL)

Si prefieres MySQL:

```env
DB_CONNECTION=mysql
DB_HOST=your-planetscale-host
DB_PORT=3306
DB_DATABASE=your-database-name
DB_USERNAME=your-username
DB_PASSWORD=your-password
```
