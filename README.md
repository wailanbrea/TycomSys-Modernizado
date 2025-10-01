# Laravel12Argon - Proyecto Base

## 🚀 Proyecto Base: Laravel 12 + Argon Dashboard React

Este es un proyecto base que combina **Laravel 12** como backend con **Argon Dashboard React** como frontend, configurado y listo para usar como punto de partida para nuevos proyectos.

## ✨ Características Incluidas

- ✅ **Laravel 12** - Framework PHP más reciente
- ✅ **Argon Dashboard React** - Dashboard moderno y responsive
- ✅ **Integración completa** - Backend y frontend funcionando juntos
- ✅ **Scripts de desarrollo** - Para ejecutar ambos entornos simultáneamente
- ✅ **API endpoints** - Laravel API configurada
- ✅ **Middleware personalizado** - Para servir archivos estáticos
- ✅ **Configuración optimizada** - Lista para desarrollo y producción

## 📁 Estructura del Proyecto

```
Laravel12Argon/
├── app/                          # Laravel backend
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── ReactController.php    # Controlador para servir React
│   │   └── Middleware/
│   │       └── StaticFilesMiddleware.php  # Middleware para archivos estáticos
│   └── ...
├── frontend/                     # React frontend (Argon Dashboard)
│   ├── src/                     # Código fuente de React
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
git clone https://github.com/tu-usuario/Laravel12Argon.git
cd Laravel12Argon
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

## 📱 Páginas Disponibles

### Frontend (React)
- `/` - Dashboard principal
- `/admin/icons` - Página de iconos
- `/admin/tables` - Página de tablas
- `/admin/maps` - Página de mapas
- `/auth/login` - Página de login
- `/auth/register` - Página de registro
- `/admin/user-profile` - Perfil de usuario

### Backend (Laravel API)
- `/api/health` - Health check
- Agregar más endpoints según necesidades

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