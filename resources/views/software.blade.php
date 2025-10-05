<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Software - Suite AQuarius | TicomSys</title>
<meta name="description" content="Conoce la Suite AQuarius Software, nuestro producto principal para digitalización masiva de documentos. Módulos especializados para gestión documental.">
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com?plugins=container-queries"></script>
<script>
    tailwind.config = {
      darkMode: "class",
      theme: {
        extend: {
          colors: {
            "primary": "#175acf",
            "secondary": "#47b2e4",
            "background-light": "#f6f7f8",
            "background-dark": "#111721",
            "foreground-light": "#0e131b",
            "foreground-dark": "#f6f7f8",
            "foreground-muted-light": "#4e6997",
            "foreground-muted-dark": "#a0aec0",
            "border-light": "#e7ecf3",
            "border-dark": "#2d3748"
          },
          fontFamily: {
            "display": ["Inter"]
          },
          borderRadius: {
            "DEFAULT": "0.5rem",
            "lg": "0.75rem",
            "xl": "1rem",
            "full": "9999px"
          },
        },
      },
    }
  </script>
<style>
    .btn-glow {
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .btn-glow:hover {
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        transform: translateY(-3px);
    }
    
    .btn-glow:active {
        transform: translateY(-1px);
    }
</style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-foreground-light dark:text-foreground-dark">
<div class="relative flex min-h-screen w-full flex-col overflow-x-hidden">
<div class="flex h-full grow flex-col">

<!-- Header -->
<header class="sticky top-0 z-50 bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-sm border-b border-border-light dark:border-border-dark">
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
<div class="flex items-center justify-between h-20">
<div class="flex items-center gap-4 w-full justify-center">
<a href="/">
<img src="{{ asset('images/logoticomsys.png') }}" alt="TicomSys Logo" class="h-16 w-auto">
</a>
</div>
<nav class="hidden md:flex items-center gap-8">
<a class="text-sm font-medium text-primary transition-colors" href="/software">Software</a>
<a class="text-sm font-medium hover:text-primary transition-colors" href="/servicios">Servicios</a>
<a class="text-sm font-medium hover:text-primary transition-colors" href="/#clients">Clientes</a>
<a class="text-sm font-medium hover:text-primary transition-colors" href="/#tech-solutions">Soluciones</a>
<a class="text-sm font-medium hover:text-primary transition-colors" href="/#contact">Contacto</a>
<a class="text-sm font-medium hover:text-primary transition-colors" href="/#about">Sobre Nosotros</a>
</nav>
</div>
</div>
</header>

<!-- Hero Section -->
<main class="flex-1">
<section class="relative bg-gradient-to-br from-primary via-secondary to-blue-600 py-16 sm:py-24">
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
<div class="text-center text-white">
<div class="flex justify-center mb-8">
<img src="{{ asset('images/Aquarius.png') }}" alt="Suite AQuarius Software" class="w-24 h-24">
</div>
<h1 class="text-4xl md:text-6xl font-bold mb-6">Suite AQuarius Software</h1>
<p class="text-xl text-white/90 max-w-3xl mx-auto">
La solución completa para digitalización masiva de documentos y gestión documental empresarial
</p>
</div>
</div>
</section>

<!-- Overview Section -->
<section class="py-12 sm:py-20">
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
<div class="max-w-7xl mx-auto">
<div class="bg-white dark:bg-background-dark rounded-2xl shadow-xl p-8 lg:p-12 mb-16">
<div class="flex flex-col lg:flex-row items-center gap-12">
<div class="lg:w-1/2">
<h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-6">
¿Qué es AQuarius?
</h2>
<p class="text-lg text-gray-600 dark:text-gray-300 mb-6">
Una solución orientada exclusivamente al manejo de documentos digitales en las empresas, contribuyendo así al ahorro de papel impreso y de esta forma a la preservación del medio ambiente.
</p>
<p class="text-gray-600 dark:text-gray-300 mb-8">
Con AQuarius podemos tomar todos los archivos físicos de su empresa, digitalizarlos a través de escáneres de alta velocidad, crear una aplicación personalizada para cada cliente, agregarles los índices para la posterior búsqueda y ponerlos a disposición tanto interno como externo a través de intranet e internet.
</p>
<div class="grid grid-cols-2 gap-4">
<div class="bg-primary/10 p-4 rounded-lg text-center">
<div class="text-2xl font-bold text-primary mb-2">25+</div>
<div class="text-sm text-gray-600 dark:text-gray-300">Años de Experiencia</div>
</div>
<div class="bg-secondary/10 p-4 rounded-lg text-center">
<div class="text-2xl font-bold text-secondary mb-2">50+</div>
<div class="text-sm text-gray-600 dark:text-gray-300">Clientes Satisfechos</div>
</div>
</div>
</div>
<div class="lg:w-1/2">
<div class="grid grid-cols-2 gap-4">
<div class="bg-green-500/10 p-6 rounded-lg text-center">
<svg class="w-8 h-8 text-green-500 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
</svg>
<div class="text-sm font-semibold text-gray-700 dark:text-gray-300">Digitalización Masiva</div>
</div>
<div class="bg-blue-500/10 p-6 rounded-lg text-center">
<svg class="w-8 h-8 text-blue-500 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
</svg>
<div class="text-sm font-semibold text-gray-700 dark:text-gray-300">Seguridad Avanzada</div>
</div>
<div class="bg-purple-500/10 p-6 rounded-lg text-center">
<svg class="w-8 h-8 text-purple-500 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"></path>
</svg>
<div class="text-sm font-semibold text-gray-700 dark:text-gray-300">Acceso 24/7</div>
</div>
<div class="bg-orange-500/10 p-6 rounded-lg text-center">
<svg class="w-8 h-8 text-orange-500 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
</svg>
<div class="text-sm font-semibold text-gray-700 dark:text-gray-300">Gestión Electrónica</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>

<!-- Modules Section -->
<section class="bg-gray-50 dark:bg-gray-900 py-20 sm:py-28">
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
<div class="max-w-7xl mx-auto">
<div class="text-center mb-16">
<h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-6">
Módulos de AQuarius
</h2>
<p class="text-lg text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
Conoce los módulos especializados que componen la Suite AQuarius para una gestión documental completa
</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
<!-- WebScan / AQWeb / AQIndex -->
<div class="bg-white dark:bg-background-dark rounded-xl shadow-lg p-8 hover:shadow-xl transition-shadow">
<div class="flex items-center gap-4 mb-6">
<div class="w-16 h-16 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
<svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
</svg>
</div>
<h3 class="text-xl font-semibold text-gray-900 dark:text-white">WebScan / AQWeb / AQIndex</h3>
</div>
<p class="text-gray-600 dark:text-gray-300 mb-6">
Módulos con los que podemos tomar sus documentos, escanearlos, cargarlos e indexarlos en cualquier formato de imagen editable, hacerles OCR y cargar los datos de índices de forma automática mediante etiquetas programadas según levantamiento de OCR.
</p>
<ul class="space-y-3 text-sm text-gray-600 dark:text-gray-300">
<li class="flex items-center gap-3">
<svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
</svg>
Acceso web desde cualquier lugar
</li>
<li class="flex items-center gap-3">
<svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
</svg>
Disponible 24/7
</li>
<li class="flex items-center gap-3">
<svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
</svg>
Solo necesita navegador web
</li>
<li class="flex items-center gap-3">
<svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
</svg>
OCR automático
</li>
</ul>
</div>

<!-- AQuarius DMS -->
<div class="bg-white dark:bg-background-dark rounded-xl shadow-lg p-8 hover:shadow-xl transition-shadow">
<div class="flex items-center gap-4 mb-6">
<div class="w-16 h-16 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center">
<svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
</svg>
</div>
<h3 class="text-xl font-semibold text-gray-900 dark:text-white">AQuarius DMS</h3>
</div>
<p class="text-gray-600 dark:text-gray-300 mb-6">
Document Management Software para el manejo de los documentos, permite capturar los documentos desde diversas fuentes, almacenarlos en medios electrónicos y permite que los usuarios los recuperen desde sus computadoras.
</p>
<ul class="space-y-3 text-sm text-gray-600 dark:text-gray-300">
<li class="flex items-center gap-3">
<svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
</svg>
Controlar y procesar documentos
</li>
<li class="flex items-center gap-3">
<svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
</svg>
Almacenar e indexar
</li>
<li class="flex items-center gap-3">
<svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
</svg>
Consultar y hacer anotaciones
</li>
<li class="flex items-center gap-3">
<svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
</svg>
Búsqueda avanzada
</li>
</ul>
</div>

<!-- AQuarius Cloud -->
<div class="bg-white dark:bg-background-dark rounded-xl shadow-lg p-8 hover:shadow-xl transition-shadow">
<div class="flex items-center gap-4 mb-6">
<div class="w-16 h-16 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center">
<svg class="w-8 h-8 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"></path>
</svg>
</div>
<h3 class="text-xl font-semibold text-gray-900 dark:text-white">AQuarius Cloud</h3>
</div>
<p class="text-gray-600 dark:text-gray-300 mb-6">
Módulo especializado que permite digitalizar sus documentos localmente y almacenarlos en línea en servidores de TICOMSYS y AQuarius Software para tenerlos accesibles desde cualquier lugar.
</p>
<ul class="space-y-3 text-sm text-gray-600 dark:text-gray-300">
<li class="flex items-center gap-3">
<svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
</svg>
Digitalización local
</li>
<li class="flex items-center gap-3">
<svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
</svg>
Almacenamiento en la nube
</li>
<li class="flex items-center gap-3">
<svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
</svg>
Sin inversión en equipos terceros
</li>
<li class="flex items-center gap-3">
<svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
</svg>
Acceso remoto seguro
</li>
</ul>
</div>
</div>
</div>
</div>
</section>

<!-- Integration Section -->
<section class="py-20 sm:py-28">
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
<div class="max-w-7xl mx-auto">
<div class="bg-white dark:bg-background-dark rounded-xl shadow-lg p-8 lg:p-12 text-center">
<h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">
Integración con Sistemas Existentes
</h2>
<p class="text-lg text-gray-600 dark:text-gray-300 mb-8 max-w-4xl mx-auto">
AQuarius puede integrarse con bases de datos como SQL Server, Oracle, entre otras, así como con los sistemas ERP, CRM o cualquier aplicación de negocios instalados en su institución.
</p>
<div class="flex flex-wrap justify-center gap-4 mb-8">
<span class="px-6 py-3 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 rounded-full text-sm font-medium">SQL Server</span>
<span class="px-6 py-3 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-full text-sm font-medium">Oracle</span>
<span class="px-6 py-3 bg-purple-100 dark:bg-purple-900 text-purple-800 dark:text-purple-200 rounded-full text-sm font-medium">ERP</span>
<span class="px-6 py-3 bg-orange-100 dark:bg-orange-900 text-orange-800 dark:text-orange-200 rounded-full text-sm font-medium">CRM</span>
<span class="px-6 py-3 bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 rounded-full text-sm font-medium">Aplicaciones de Negocio</span>
<span class="px-6 py-3 bg-indigo-100 dark:bg-indigo-900 text-indigo-800 dark:text-indigo-200 rounded-full text-sm font-medium">MySQL</span>
<span class="px-6 py-3 bg-teal-100 dark:bg-teal-900 text-teal-800 dark:text-teal-200 rounded-full text-sm font-medium">PostgreSQL</span>
</div>
<div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-6">
<h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Beneficios de la Integración</h3>
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm text-gray-600 dark:text-gray-300">
<div class="flex items-center gap-2">
<svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
</svg>
Sincronización automática
</div>
<div class="flex items-center gap-2">
<svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
</svg>
Datos unificados
</div>
<div class="flex items-center gap-2">
<svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
</svg>
Flujo de trabajo optimizado
</div>
</div>
</div>
</div>
</div>
</div>
</section>

<!-- CTA Section -->
<section class="bg-primary py-20 sm:py-28">
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
<div class="text-center text-white">
<h2 class="text-3xl md:text-4xl font-bold mb-6">¿Listo para digitalizar su empresa?</h2>
<p class="text-xl text-white/90 mb-8 max-w-2xl mx-auto">
Solicite una demostración personalizada de la Suite AQuarius y descubra cómo puede transformar la gestión documental de su organización
</p>
<div class="flex flex-col sm:flex-row gap-4 justify-center">
<a href="/#contact" class="bg-white text-primary font-semibold px-8 py-3 rounded-lg btn-glow">
Solicitar Demostración
</a>
<a href="/servicios" class="bg-secondary text-white font-semibold px-8 py-3 rounded-lg btn-glow">
Ver Todos los Servicios
</a>
</div>
</div>
</div>
</section>

</main>

<!-- Footer -->
<footer class="bg-background-light dark:bg-background-dark border-t border-border-light dark:border-border-dark">
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
<div class="flex flex-col md:flex-row justify-between items-center gap-8">
<div class="flex flex-wrap justify-center md:justify-start gap-x-6 gap-y-2 text-sm text-foreground-muted-light dark:text-foreground-muted-dark">
<a class="hover:text-primary transition-colors" href="/#about">Sobre Nosotros</a>
<a class="hover:text-primary transition-colors" href="/servicios">Servicios</a>
<a class="hover:text-primary transition-colors" href="/software">Software</a>
<a class="hover:text-primary transition-colors" href="/#clients">Clientes</a>
<a class="hover:text-primary transition-colors" href="/reparaciones">Reparaciones</a>
<a class="hover:text-primary transition-colors" href="/#contact">Contacto</a>
</div>
<p class="text-sm text-foreground-muted-light dark:text-foreground-muted-dark">© 2025 BSolutions.Dev. Todos los derechos reservados.</p>
</div>
</div>
</footer>
</div>
</div>

</body>
</html>
