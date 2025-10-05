<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Servicios - TicomSys</title>
<meta name="description" content="Conoce todos nuestros servicios especializados en tecnología y gestión documental. Desde digitalización masiva hasta soporte técnico.">
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
<a class="text-sm font-medium hover:text-primary transition-colors" href="/#about">Sobre Nosotros</a>
<a class="text-sm font-medium text-primary transition-colors" href="/servicios">Servicios</a>
<a class="text-sm font-medium hover:text-primary transition-colors" href="/software">Software</a>
<a class="text-sm font-medium hover:text-primary transition-colors" href="/#clients">Clientes</a>
<a class="text-sm font-medium hover:text-primary transition-colors" href="/#tech-solutions">Soluciones</a>
<a class="text-sm font-medium hover:text-primary transition-colors" href="/reparaciones">Reparaciones</a>
<a class="text-sm font-medium hover:text-primary transition-colors" href="/#contact">Contacto</a>
</nav>
</div>
</div>
</header>

<!-- Hero Section -->
<main class="flex-1">
<section class="relative bg-gradient-to-br from-primary via-secondary to-blue-600 py-20 sm:py-28">
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
<div class="text-center text-white">
<h1 class="text-4xl md:text-6xl font-bold mb-6">Nuestros Servicios</h1>
<p class="text-xl text-white/90 max-w-3xl mx-auto">
Especialistas en tecnología y gestión documental con más de 25 años de experiencia
</p>
</div>
</div>
</section>

<!-- Services Grid -->
<section class="py-20 sm:py-28">
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
<div class="max-w-7xl mx-auto">
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
<!-- Servicio 1 -->
<div class="bg-white dark:bg-background-dark p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
<div class="w-16 h-16 bg-primary/10 rounded-lg flex items-center justify-center mb-6">
<img src="{{ asset('images/Aquarius.png') }}" alt="AQuarius Logo" class="w-10 h-10 object-contain">
</div>
<h3 class="text-xl font-bold mb-4">Suite AQuarius Software</h3>
<p class="text-foreground-muted-light dark:text-foreground-muted-dark mb-6">
Venta y Soporte Técnico Exclusivo a la suite AQuarius Software para digitalización masiva de documentos.
</p>
<a href="/software" class="text-primary hover:text-primary/80 font-semibold">Ver detalles →</a>
</div>

<!-- Servicio 2 -->
<div class="bg-white dark:bg-background-dark p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
<div class="w-16 h-16 bg-secondary/10 rounded-lg flex items-center justify-center mb-6">
<svg class="w-10 h-10 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
</svg>
</div>
<h3 class="text-xl font-bold mb-4">Asesorías Informáticas</h3>
<p class="text-foreground-muted-light dark:text-foreground-muted-dark mb-6">
Consultoría especializada en soluciones tecnológicas para empresas. Optimizamos sus procesos digitales.
</p>
<a href="/#contact" class="text-primary hover:text-primary/80 font-semibold">Contactar →</a>
</div>

<!-- Servicio 3 -->
<div class="bg-white dark:bg-background-dark p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
<div class="w-16 h-16 bg-green-500/10 rounded-lg flex items-center justify-center mb-6">
<svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
</svg>
</div>
<h3 class="text-xl font-bold mb-4">Tratamiento Archivístico</h3>
<p class="text-foreground-muted-light dark:text-foreground-muted-dark mb-6">
Tratamiento Archivístico y Organización de Documentos (físicos y digitales) con metodologías profesionales.
</p>
<a href="/#contact" class="text-primary hover:text-primary/80 font-semibold">Más información →</a>
</div>

<!-- Servicio 4 -->
<div class="bg-white dark:bg-background-dark p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
<div class="w-16 h-16 bg-blue-500/10 rounded-lg flex items-center justify-center mb-6">
<svg class="w-10 h-10 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
</svg>
</div>
<h3 class="text-xl font-bold mb-4">Soporte Técnico</h3>
<p class="text-foreground-muted-light dark:text-foreground-muted-dark mb-6">
Soporte técnico especializado para equipos y sistemas informáticos con respuesta rápida y eficiente.
</p>
<a href="/#contact" class="text-primary hover:text-primary/80 font-semibold">Solicitar soporte →</a>
</div>

<!-- Servicio 5 -->
<div class="bg-white dark:bg-background-dark p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
<div class="w-16 h-16 bg-purple-500/10 rounded-lg flex items-center justify-center mb-6">
<svg class="w-10 h-10 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2m-9 0h10m-10 0a2 2 0 00-2 2v14a2 2 0 002 2h10a2 2 0 002-2V6a2 2 0 00-2-2M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
</svg>
</div>
<h3 class="text-xl font-bold mb-4">Digitalización Masiva</h3>
<p class="text-foreground-muted-light dark:text-foreground-muted-dark mb-6">
Digitalización Masiva de Documentos con personal, equipos, software y experiencia especializada.
</p>
<a href="/#contact" class="text-primary hover:text-primary/80 font-semibold">Consultar →</a>
</div>

<!-- Servicio 6 -->
<div class="bg-white dark:bg-background-dark p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
<div class="w-16 h-16 bg-red-500/10 rounded-lg flex items-center justify-center mb-6">
<svg class="w-10 h-10 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path>
</svg>
</div>
<h3 class="text-xl font-bold mb-4">Equipos Tecnológicos</h3>
<p class="text-foreground-muted-light dark:text-foreground-muted-dark mb-6">
Venta de Equipos Tecnológicos de última generación con garantía y soporte técnico incluido.
</p>
<a href="/#contact" class="text-primary hover:text-primary/80 font-semibold">Ver catálogo →</a>
</div>

<!-- Servicio 7 -->
<div class="bg-white dark:bg-background-dark p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
<div class="w-16 h-16 bg-yellow-500/10 rounded-lg flex items-center justify-center mb-6">
<svg class="w-10 h-10 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
</svg>
</div>
<h3 class="text-xl font-bold mb-4">Entrenamientos</h3>
<p class="text-foreground-muted-light dark:text-foreground-muted-dark mb-6">
Entrenamientos sobre Digitalización y Organización Documental para capacitar a su equipo.
</p>
<a href="/#contact" class="text-primary hover:text-primary/80 font-semibold">Programar →</a>
</div>

<!-- Servicio 8 -->
<div class="bg-white dark:bg-background-dark p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
<div class="w-16 h-16 bg-indigo-500/10 rounded-lg flex items-center justify-center mb-6">
<svg class="w-10 h-10 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
</svg>
</div>
<h3 class="text-xl font-bold mb-4">Escáneres Alto Volumen</h3>
<p class="text-foreground-muted-light dark:text-foreground-muted-dark mb-6">
Venta y Soporte Técnico a Escáneres de Alto Volumen para manejo eficiente de documentos.
</p>
<a href="/#contact" class="text-primary hover:text-primary/80 font-semibold">Consultar →</a>
</div>

<!-- Servicio 9 -->
<div class="bg-white dark:bg-background-dark p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
<div class="w-16 h-16 bg-teal-500/10 rounded-lg flex items-center justify-center mb-6">
<svg class="w-10 h-10 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
</svg>
</div>
<h3 class="text-xl font-bold mb-4">Acuerdos de Servicios</h3>
<p class="text-foreground-muted-light dark:text-foreground-muted-dark mb-6">
Acuerdos de Servicios Técnicos especializados con planes de mantenimiento preventivo.
</p>
<a href="/#contact" class="text-primary hover:text-primary/80 font-semibold">Ver planes →</a>
</div>

<!-- Servicio 10 -->
<div class="bg-white dark:bg-background-dark p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
<div class="w-16 h-16 bg-orange-500/10 rounded-lg flex items-center justify-center mb-6">
<svg class="w-10 h-10 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
</svg>
</div>
<h3 class="text-xl font-bold mb-4">Inventario Local</h3>
<p class="text-foreground-muted-light dark:text-foreground-muted-dark mb-6">
Inventario Local de Recursos Técnicos y Desarrolladores para atención inmediata.
</p>
<a href="/#contact" class="text-primary hover:text-primary/80 font-semibold">Conocer más →</a>
</div>
</div>
</div>
</div>
</section>

<!-- CTA Section -->
<section class="bg-primary py-20 sm:py-28">
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
<div class="text-center text-white">
<h2 class="text-3xl md:text-4xl font-bold mb-6">¿Necesitas más información?</h2>
<p class="text-xl text-white/90 mb-8 max-w-2xl mx-auto">
Contáctanos para conocer cómo podemos ayudarte con tus necesidades tecnológicas
</p>
<div class="flex flex-col sm:flex-row gap-4 justify-center">
<a href="/#contact" class="bg-white text-primary font-semibold px-8 py-3 rounded-lg btn-glow">
Contactar Ahora
</a>
<a href="/" class="bg-secondary text-white font-semibold px-8 py-3 rounded-lg btn-glow">
Volver al Inicio
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
