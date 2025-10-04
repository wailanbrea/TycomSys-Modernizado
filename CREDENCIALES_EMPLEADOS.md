# 🔐 Credenciales de Empleados - TICOMSYS

## Acceso al Sistema

### URL de Login
```
http://localhost:8000/ticomsyslogin
```

### Credenciales de Prueba

| Rol | Email | Contraseña | Descripción |
|-----|-------|------------|-------------|
| **Administrador** | admin@ticomsys.com | admin123 | Acceso completo al sistema |
| **Técnico** | tecnico@ticomsys.com | tecnico123 | Acceso técnico especializado |
| **Empleado** | empleado@ticomsys.com | empleado123 | Acceso básico de empleado |

## Flujo de Autenticación

1. **Acceso Público**: `http://localhost:8000/` - Página principal de TycomSys
2. **Login Oculto**: `http://localhost:8000/ticomsyslogin` - Solo para empleados
3. **Dashboard**: `http://localhost:8000/dashboard` - Protegido, requiere login

## Características de Seguridad

- ✅ **Login oculto** - No aparece en la navegación principal
- ✅ **URL específica** - Solo accesible con la URL exacta
- ✅ **Middleware de protección** - Dashboard protegido
- ✅ **Sesiones seguras** - Manejo de sesiones con Laravel
- ✅ **Redirección automática** - Al dashboard después del login
- ✅ **Logout seguro** - Limpieza completa de sesión

## Notas Importantes

- El sistema está configurado para desarrollo
- En producción, las credenciales deben almacenarse en base de datos
- Se recomienda implementar hash de contraseñas
- Considerar implementar 2FA para mayor seguridad

## Próximos Pasos

1. Implementar base de datos de usuarios
2. Sistema de gestión de reparaciones
3. Panel de administración completo
4. Notificaciones por email/WhatsApp

