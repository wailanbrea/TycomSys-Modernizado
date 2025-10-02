# TycomSys - Modernizado

## 🚀 Proyecto: Modernización de TycomSys con Laravel 12 + Argon Dashboard React

Este proyecto moderniza la página web de **TycomSys** y implementa un sistema completo de gestión de reparaciones, utilizando **Laravel 12** como backend y **Argon Dashboard React** como frontend.

## ✨ Características del Proyecto

### 🏢 **Sobre TycomSys**
- **Empresa:** TycomSys - Soluciones Informáticas
- **Especialización:** Gestión Documental (AQuarius Software) y Soluciones Tecnológicas
- **Experiencia:** 25+ años en el mercado
- **Ubicación:** Santo Domingo, República Dominicana

### 🛠️ **Características Técnicas**
- ✅ **Laravel 12** - Framework PHP más reciente
- ✅ **Argon Dashboard React** - Dashboard moderno y responsive
- ✅ **Integración completa** - Backend y frontend funcionando juntos
- ✅ **Scripts de desarrollo** - Para ejecutar ambos entornos simultáneamente
- ✅ **API endpoints** - Laravel API configurada
- ✅ **Middleware personalizado** - Para servir archivos estáticos
- ✅ **Sistema de reparaciones** - Gestión completa de equipos

## 📁 Estructura del Proyecto

```
TycomSys-Modernizado/
├── app/                          # Laravel backend
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── ReactController.php    # Controlador para servir React
│   │   │   ├── RepairController.php   # Gestión de reparaciones
│   │   │   └── EquipmentController.php # Gestión de equipos
│   │   └── Middleware/
│   │       └── StaticFilesMiddleware.php  # Middleware para archivos estáticos
│   └── ...
├── frontend/                     # React frontend (Argon Dashboard)
│   ├── src/                     # Código fuente de React
│   │   ├── components/          # Componentes personalizados
│   │   ├── pages/              # Páginas específicas de TycomSys
│   │   └── services/           # Servicios para reparaciones
│   ├── public/                  # Archivos públicos de React
│   ├── build/                   # Build de producción de React
│   └── package.json
├── resources/
│   └── views/
│       └── react-app.blade.php  # Vista de respaldo para React
├── routes/
│   └── web.php                  # Rutas configuradas
├── package.json                 # Scripts de desarrollo
└── README.md
```

## 🛠️ Instalación Rápida

### 1. Clonar el Repositorio
```bash
git clone https://github.com/wailanbrea/TycomSys-Modernizado.git
cd TycomSys-Modernizado
```

### 2. Instalar Dependencias
```bash
# Dependencias de Laravel
composer install

# Dependencias de React
npm install
npm run install-deps
```

### 3. Configurar Laravel
```bash
cp .env.example .env
php artisan key:generate
php artisan migrate
```

### 4. Compilar React
```bash
npm run build
```

### 5. Ejecutar el Proyecto
```bash
php artisan serve
```

¡Listo! Tu aplicación estará disponible en `http://localhost:8000`

## 🚀 Comandos de Desarrollo

### Desarrollo Completo
```bash
npm run dev  # Ejecuta Laravel + React simultáneamente
```

### Solo Laravel
```bash
npm start
# o
php artisan serve
```

### Solo React
```bash
npm run frontend
# o
cd frontend && npm start
```

### Compilar para Producción
```bash
npm run build
```

## 🌐 URLs de Acceso

- **Aplicación Principal:** http://localhost:8000
- **API Health Check:** http://localhost:8000/api/health
- **React Dev Server:** http://localhost:3000 (en modo desarrollo)

## 🎯 Funcionalidades de TycomSys

### 🌐 **Página Web Modernizada**
- **Hero Section** con animaciones y diseño moderno
- **Servicios** - Gestión Documental y Soluciones Tecnológicas
- **Clientes** - Portfolio de clientes destacados
- **Sistema de Reparaciones** - Formulario y seguimiento
- **Contacto** - Información y formulario de contacto

### 🔧 **Sistema de Gestión de Reparaciones**
- **Formulario de Solicitud** - Para clientes que necesiten reparación
- **Dashboard de Administración** - Gestión completa de reparaciones
- **Seguimiento en Tiempo Real** - Estado actualizado de cada reparación
- **Notificaciones** - Email y SMS para actualizaciones
- **Portal del Cliente** - Consulta de estado de reparaciones

### 📱 Páginas Disponibles

#### Frontend (React)
- `/` - Página principal de TycomSys
- `/servicios` - Servicios de la empresa
- `/clientes` - Portfolio de clientes
- `/reparaciones` - Sistema de reparaciones
- `/contacto` - Información de contacto
- `/admin/dashboard` - Dashboard de administración
- `/admin/repairs` - Gestión de reparaciones
- `/admin/customers` - Gestión de clientes

#### Backend (Laravel API)
- `/api/health` - Health check
- `/api/repairs` - API de reparaciones
- `/api/equipment` - API de equipos
- `/api/customers` - API de clientes

## 🔧 Personalización

### Modificar React Frontend
1. Edita los archivos en `frontend/src/`
2. Ejecuta `npm run build` para aplicar cambios
3. Los cambios se reflejarán en la aplicación

### Modificar Laravel Backend
1. Edita los archivos en `app/`
2. Modifica las rutas en `routes/web.php`
3. Agrega nuevos controladores y modelos según necesidades

### Agregar Nuevas Páginas React
1. Crea componentes en `frontend/src/views/`
2. Agrega rutas en `frontend/src/routes.js`
3. Compila con `npm run build`

## 🗃️ Base de Datos

El proyecto incluye las migraciones básicas de Laravel:
- Tabla de usuarios
- Tabla de cache
- Tabla de jobs

Para agregar nuevas tablas:
```bash
php artisan make:migration create_nombre_tabla
php artisan migrate
```

## 📦 Dependencias Principales

### Laravel
- Laravel Framework 12.x
- Laravel Sanctum (para autenticación API)
- Laravel Tinker
- Laravel Sail (opcional)

### React
- React 18.x
- Argon Dashboard React
- React Router
- Bootstrap
- Chart.js

## 🚀 Uso como Proyecto Base

Este repositorio está diseñado para ser usado como base para nuevos proyectos:

1. **Clona el repositorio**
2. **Renombra la carpeta** según tu proyecto
3. **Modifica la configuración** en `.env`
4. **Personaliza el frontend** según tus necesidades
5. **Agrega funcionalidades** al backend

## 📝 Próximos Pasos Sugeridos

- [ ] Configurar autenticación con Laravel Sanctum
- [ ] Agregar sistema de roles y permisos
- [ ] Implementar API endpoints específicos
- [ ] Personalizar el dashboard según necesidades
- [ ] Configurar base de datos para tu aplicación
- [ ] Agregar tests unitarios y de integración

## 🐛 Troubleshooting

### Error: "Asset not found"
```bash
npm run build
```

### Error: "Application not loading"
```bash
php artisan serve
```

### Error: "React app not found"
Verifica que `frontend/build/index.html` exista después de `npm run build`

## 📄 Licencia

Este proyecto está bajo la Licencia MIT. Ver el archivo `LICENSE` para más detalles.

## 🤝 Contribución

1. Fork el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

---

## 📞 Soporte

Si tienes problemas o preguntas, puedes:
- Abrir un issue en GitHub
- Revisar la documentación de [Laravel](https://laravel.com/docs)
- Revisar la documentación de [Argon Dashboard](https://demos.creative-tim.com/argon-dashboard-react/)

**¡Disfruta desarrollando con Laravel 12 + Argon Dashboard React!** 🎉