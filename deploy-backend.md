# Despliegue del Backend Laravel en Railway

## 🚀 Pasos para Desplegar Backend

### 1. Preparar el Proyecto
```bash
# Crear archivo Procfile para Railway
echo "web: php artisan serve --host=0.0.0.0 --port=\$PORT" > Procfile

# Crear archivo .env.production
cp .env .env.production
```

### 2. Instalar Railway CLI
```bash
# Instalar Railway CLI
npm install -g @railway/cli

# O usar npx
npx @railway/cli login
```

### 3. Configurar Proyecto en Railway
```bash
# Login en Railway
railway login

# Inicializar proyecto
railway init

# Conectar a GitHub (opcional)
railway connect
```

### 4. Configurar Base de Datos
```bash
# Crear servicio PostgreSQL
railway add postgresql

# Obtener variables de conexión
railway variables
```

### 5. Configurar Variables de Entorno
```bash
# Configurar variables en Railway
railway variables set APP_ENV=production
railway variables set APP_DEBUG=false
railway variables set APP_URL=https://tu-proyecto.railway.app

# Configurar base de datos
railway variables set DB_CONNECTION=pgsql
railway variables set DB_HOST=${{Postgres.PGHOST}}
railway variables set DB_PORT=${{Postgres.PGPORT}}
railway variables set DB_DATABASE=${{Postgres.PGDATABASE}}
railway variables set DB_USERNAME=${{Postgres.PGUSER}}
railway variables set DB_PASSWORD=${{Postgres.PGPASSWORD}}

# Generar APP_KEY
railway run php artisan key:generate --force
```

### 6. Ejecutar Migraciones
```bash
# Ejecutar migraciones
railway run php artisan migrate --force

# Ejecutar seeders
railway run php artisan db:seed --force
```

### 7. Desplegar
```bash
# Desplegar
railway up

# Ver logs
railway logs
```

## 🔧 Configuración Adicional

### CORS Configuration
```php
// config/cors.php
return [
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
];
```

### Configurar Storage
```php
// config/filesystems.php
'default' => env('FILESYSTEM_DISK', 'public'),
'disks' => [
    'public' => [
        'driver' => 'local',
        'root' => storage_path('app/public'),
        'url' => env('APP_URL').'/storage',
        'visibility' => 'public',
    ],
],
```

## 📋 Checklist de Despliegue

- [ ] Railway CLI instalado
- [ ] Proyecto inicializado en Railway
- [ ] Base de datos PostgreSQL configurada
- [ ] Variables de entorno configuradas
- [ ] Migraciones ejecutadas
- [ ] Seeders ejecutados
- [ ] CORS configurado
- [ ] Despliegue exitoso
- [ ] Health check funcionando
- [ ] API endpoints probados

## 🔗 URLs Importantes

- **Railway Dashboard**: https://railway.app/dashboard
- **API Health Check**: https://tu-proyecto.railway.app/api/health
- **API Base URL**: https://tu-proyecto.railway.app/api

## 💡 Tips

1. **Monitoreo**: Usar Railway logs para debug
2. **Variables**: Usar Railway variables para configuración
3. **Dominio**: Configurar dominio personalizado si es necesario
4. **SSL**: Railway incluye SSL automático
5. **Escalado**: Railway escala automáticamente
