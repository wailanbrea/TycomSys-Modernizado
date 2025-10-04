# 🌱 Deploy con Seeders - Datos de Prueba

## ✅ **Seeders Configurados:**

### **📋 Orden de Ejecución:**
1. **RolePermissionSeeder** - Roles y permisos del sistema
2. **SystemSettingsSeeder** - Configuraciones del sistema
3. **EquipmentDataSeeder** - Marcas, tipos y modelos de equipos
4. **TechnicianSeeder** - Usuarios técnicos de prueba
5. **RepairEquipmentSeeder** - Equipos de reparación de prueba
6. **InvoiceSeeder** - Facturas de prueba
7. **InventorySeeder** - Inventario de prueba

## 🔧 **Configuración en Laravel Cloud:**

### **1. Variables de Entorno Necesarias:**
```env
APP_NAME="TICOMSYS"
APP_ENV=production
APP_KEY=base64:hUsr90G96/hG75Q3GfI+IW55vyt4PhgM2+SUMS+e38Q=
APP_DEBUG=false
APP_URL=https://tycomsys-modernizado-main-xaiitl.laravel.cloud

DB_CONNECTION=mysql
DB_HOST=tu-host-mysql
DB_DATABASE=laravel_ticomsys
DB_USERNAME=tu-usuario
DB_PASSWORD=tu-password

# Configuraciones adicionales
LOG_CHANNEL=stack
LOG_LEVEL=error
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
```

### **2. Scripts de Deploy Automáticos:**

El `composer.json` ahora incluye scripts que se ejecutan automáticamente:

```json
"post-install-cmd": [
    "@php artisan migrate --force",
    "@php artisan db:seed --force",
    "@php artisan config:cache",
    "@php artisan route:cache",
    "@php artisan view:cache"
],
"deploy": [
    "@php artisan migrate --force",
    "@php artisan db:seed --force",
    "@php artisan config:cache",
    "@php artisan route:cache",
    "@php artisan view:cache",
    "@php artisan storage:link"
]
```

## 📊 **Datos de Prueba que se Cargarán:**

### **👥 Usuarios:**
- **Admin:** admin@ticomsys.com / password
- **Técnicos:** Varios técnicos con diferentes roles
- **Empleados:** Usuarios de prueba

### **🔧 Equipos:**
- **Marcas:** Dell, HP, Canon, Epson, etc.
- **Tipos:** Laptop, Desktop, Impresora, etc.
- **Modelos:** Modelos específicos por marca

### **📋 Equipos de Reparación:**
- Equipos en diferentes estados
- Tickets asociados
- Información de clientes

### **💰 Facturas:**
- Facturas de ejemplo
- Items de facturación
- Estados diferentes (draft, paid, etc.)

### **📦 Inventario:**
- Items de inventario
- Movimientos de stock
- Categorías de productos

## 🚀 **Proceso de Deploy:**

### **Automático en Laravel Cloud:**
1. **Instalación de dependencias** (`composer install`)
2. **Ejecución automática** de `post-install-cmd`
3. **Migraciones** ejecutadas (`migrate --force`)
4. **Seeders** ejecutados (`db:seed --force`)
5. **Cache** optimizado para producción
6. **Aplicación** lista para usar

### **Manual (si es necesario):**
```bash
# En Laravel Cloud terminal o local
php artisan migrate --force
php artisan db:seed --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 🎯 **Verificación Post-Deploy:**

### **✅ Checklist:**
- ✅ Usuarios creados (admin, técnicos)
- ✅ Equipos de reparación con datos
- ✅ Facturas de prueba
- ✅ Inventario poblado
- ✅ Configuraciones del sistema
- ✅ Dashboard funcional con datos

## 🔑 **Credenciales de Acceso:**

### **👤 Usuario Administrador:**
- **Email:** admin@ticomsys.com
- **Password:** password
- **Rol:** Administrador

### **👨‍💻 Usuarios Técnicos:**
- Varios técnicos con diferentes permisos
- Credenciales en la base de datos

## 📝 **Notas Importantes:**

1. **Datos de Producción:** Los seeders solo se ejecutan si la base de datos está vacía
2. **Seguridad:** Cambiar credenciales por defecto en producción
3. **Backup:** Hacer backup antes de ejecutar seeders en producción
4. **Logs:** Verificar logs para confirmar que los seeders se ejecutaron correctamente

## 🎉 **¡Resultado Final:**

Después del deploy, tendrás:
- ✅ Sistema completamente funcional
- ✅ Datos de prueba cargados
- ✅ Usuarios y roles configurados
- ✅ Dashboard con información real
- ✅ Todas las funcionalidades operativas
