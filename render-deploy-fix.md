# 🔧 Solución Error 500 en Render - TicomSys

## Problema Identificado
Error 500 al hacer login en producción en Render.com

## Causas Principales
1. **Falta APP_URL** en variables de entorno
2. **APP_DEBUG=false** oculta errores específicos
3. **Faltan migraciones/seeders** en el build
4. **Permisos de storage** no configurados

## Soluciones Implementadas

### 1. Actualizado render.yaml
```yaml
envVars:
  - key: APP_DEBUG
    value: true  # Temporal para debug
  - key: APP_URL
    value: https://ticomsys-complete.onrender.com
  - key: LOG_LEVEL
    value: debug
```

### 2. BuildCommand Mejorado
```bash
composer install --no-dev --optimize-autoloader && 
php artisan key:generate --force && 
php artisan migrate --force && 
php artisan db:seed --force && 
cd frontend && npm install && npm run build
```

## Pasos para Aplicar la Solución

### Opción 1: Redesplegar desde GitHub
1. Hacer commit y push de los cambios:
```bash
git add render.yaml
git commit -m "Fix: configurar APP_URL y debug para Render"
git push origin main
```

2. En Render.com:
   - Ir a tu servicio
   - Hacer "Manual Deploy" → "Deploy latest commit"

### Opción 2: Configurar Variables Manualmente
En el panel de Render:
1. Ir a tu servicio `ticomsys-complete`
2. Environment → Add Environment Variable:
   - `APP_URL` = `https://ticomsys-complete.onrender.com`
   - `APP_DEBUG` = `true` (temporal)
   - `LOG_LEVEL` = `debug`

### Opción 3: Verificar Logs
1. En Render → Service → Logs
2. Buscar errores específicos
3. Verificar que las migraciones se ejecuten

## Verificaciones Post-Deploy

### 1. Health Check
```
https://ticomsys-complete.onrender.com/api/health
```

### 2. Login Test
```
https://ticomsys-complete.onrender.com/ticomsyslogin
```

### 3. Credenciales
- Admin: admin@ticomsys.com / admin123
- Técnico: tecnico@ticomsys.com / tecnico123

## Si Persiste el Error

### Revisar Logs Específicos
1. **Database Connection**: Verificar que PostgreSQL esté conectado
2. **Storage Permissions**: Verificar permisos de storage/
3. **APP_KEY**: Verificar que se genere correctamente

### Comandos de Debug
```bash
# En Render (si tienes acceso SSH)
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

## Notas Importantes
- APP_DEBUG=true es temporal para debug
- Cambiar a false una vez solucionado
- Verificar que todas las variables de entorno estén configuradas
- Las migraciones deben ejecutarse en cada deploy

## Próximos Pasos
1. Aplicar cambios
2. Hacer redeploy
3. Probar login
4. Si funciona, cambiar APP_DEBUG=false
5. Hacer commit final
