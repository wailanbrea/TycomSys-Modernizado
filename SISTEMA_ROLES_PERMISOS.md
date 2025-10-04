# Sistema de Roles y Permisos - TicomSys

## 📋 Descripción

Se ha implementado un sistema completo de roles y permisos para el proyecto Laravel TicomSys, que permite controlar el acceso a diferentes funcionalidades del sistema basado en los roles de los usuarios.

## 🏗️ Estructura del Sistema

### Tablas de Base de Datos
- `roles` - Almacena los roles del sistema
- `permissions` - Almacena los permisos disponibles
- `role_user` - Tabla pivot para asignar roles a usuarios
- `permission_role` - Tabla pivot para asignar permisos a roles

### Modelos
- `Role` - Modelo para manejar roles
- `Permission` - Modelo para manejar permisos
- `User` - Modelo extendido con métodos para roles y permisos

## 👥 Roles Creados

### 1. Administrador (`admin`)
- **Descripción**: Acceso completo al sistema
- **Permisos**: Todos los permisos disponibles
- **Usuario**: admin@ticomsys.com / admin123

### 2. Técnico (`tecnico`)
- **Descripción**: Acceso limitado para tareas técnicas
- **Permisos**: 
  - Ver Dashboard
  - Gestionar Equipos
  - Ver Reportes
  - Gestionar Tickets
  - Ver Tickets
- **Usuario**: tecnico@ticomsys.com / tecnico123

## 🔐 Permisos Disponibles

1. **manage_users** - Gestionar Usuarios
2. **manage_roles** - Gestionar Roles
3. **view_dashboard** - Ver Dashboard
4. **manage_equipment** - Gestionar Equipos
5. **view_reports** - Ver Reportes
6. **manage_tickets** - Gestionar Tickets
7. **view_tickets** - Ver Tickets

## 🛡️ Middleware Implementados

### RoleMiddleware
Protege rutas basándose en roles específicos.

```php
Route::middleware('role:admin')->group(function () {
    // Rutas solo para administradores
});
```

### PermissionMiddleware
Protege rutas basándose en permisos específicos.

```php
Route::middleware('permission:manage_users')->group(function () {
    // Rutas que requieren permiso de gestión de usuarios
});
```

## 🛠️ Uso en Controladores

### Verificar Roles
```php
// En el constructor del controlador
public function __construct()
{
    $this->middleware('role:admin');
}

// En métodos específicos
public function users()
{
    $this->middleware('permission:manage_users');
    // Lógica del método
}
```

### Verificar en el Código
```php
// Verificar si el usuario tiene un rol
if (auth()->user()->hasRole('admin')) {
    // Lógica para administradores
}

// Verificar si el usuario tiene un permiso
if (auth()->user()->hasPermissionTo('manage_users')) {
    // Lógica para usuarios con permiso
}

// Verificar múltiples roles
if (auth()->user()->hasAnyRole(['admin', 'tecnico'])) {
    // Lógica para admin o técnico
}
```

## 🛣️ Rutas Configuradas

### Rutas de Administrador
- `GET /admin/dashboard` - Dashboard de administrador
- `GET /admin/users` - Gestión de usuarios
- `GET /admin/roles` - Gestión de roles
- `POST /admin/users/{user}/assign-role` - Asignar rol a usuario
- `DELETE /admin/users/{user}/remove-role/{role}` - Remover rol de usuario

### Rutas de Técnico
- `GET /tecnico/dashboard` - Dashboard de técnico
- `GET /tecnico/equipment` - Gestión de equipos
- `GET /tecnico/tickets` - Ver tickets
- `GET /tecnico/reports` - Ver reportes

## 🔧 Comandos Artisan

### Verificar Sistema de Roles
```bash
php artisan roles:check
```
Este comando muestra:
- Todos los roles y sus permisos
- Todos los usuarios y sus roles asignados
- Todos los permisos disponibles
- Credenciales de acceso

## 📝 Métodos Disponibles en el Modelo User

```php
// Asignar rol
$user->assignRole($role);

// Remover rol
$user->removeRole($role);

// Verificar rol
$user->hasRole('admin');

// Verificar múltiples roles
$user->hasAnyRole(['admin', 'tecnico']);

// Verificar permiso
$user->hasPermissionTo('manage_users');

// Obtener todos los permisos
$user->getAllPermissions();
```

## 📝 Métodos Disponibles en el Modelo Role

```php
// Asignar permiso
$role->givePermissionTo($permission);

// Remover permiso
$role->revokePermissionTo($permission);

// Verificar permiso
$role->hasPermissionTo('manage_users');
```

## 🚀 Cómo Usar

1. **Acceder al sistema**:
   - Admin: admin@ticomsys.com / admin123
   - Técnico: tecnico@ticomsys.com / tecnico123

2. **Proteger nuevas rutas**:
   ```php
   Route::middleware(['auth', 'role:admin'])->group(function () {
       // Rutas protegidas
   });
   ```

3. **Verificar permisos en vistas**:
   ```php
   @if(auth()->user()->hasPermissionTo('manage_users'))
       <button>Gestionar Usuarios</button>
   @endif
   ```

## 🔄 Extensión del Sistema

Para agregar nuevos roles o permisos:

1. **Crear nuevo rol**:
   ```php
   $role = Role::create([
       'name' => 'supervisor',
       'display_name' => 'Supervisor',
       'description' => 'Rol de supervisor'
   ]);
   ```

2. **Crear nuevo permiso**:
   ```php
   $permission = Permission::create([
       'name' => 'manage_inventory',
       'display_name' => 'Gestionar Inventario',
       'description' => 'Gestionar inventario de equipos'
   ]);
   ```

3. **Asignar permisos a roles**:
   ```php
   $role->givePermissionTo($permission);
   ```

## ✅ Estado del Sistema

- ✅ Migraciones ejecutadas
- ✅ Modelos configurados
- ✅ Middleware implementados
- ✅ Controladores creados
- ✅ Rutas configuradas
- ✅ Usuarios y roles creados
- ✅ Comando de verificación funcionando

El sistema está completamente funcional y listo para usar.


