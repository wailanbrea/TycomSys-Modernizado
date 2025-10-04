<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>TicomSys - Soluciones Informáticas a su Servicio</title>
<meta name="description" content="TicomSys ofrece soluciones informáticas completas, digitalización masiva de documentos con Suite AQuarius, y servicios de reparación de equipos en República Dominicana.">
<meta name="keywords" content="TicomSys, soluciones informáticas, digitalización, AQuarius, reparación equipos, República Dominicana, Santo Domingo">
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
    .text-shadow {
        text-shadow: 1px 1px 3px rgba(0,0,0,0.4);
    }
    
    /* Animación de scroll infinito */
    @keyframes scroll {
        0% {
            transform: translateX(0);
        }
        100% {
            transform: translateX(-50%);
        }
    }
    
    @keyframes scroll-reverse {
        0% {
            transform: translateX(-50%);
        }
        100% {
            transform: translateX(0);
        }
    }
    
    .animate-scroll {
        animation: scroll 40s linear infinite;
    }
    
    .animate-scroll-reverse {
        animation: scroll-reverse 35s linear infinite;
    }
    
.animate-scroll:hover,
.animate-scroll-reverse:hover {
    animation-play-state: paused;
}

/* Carrusel automático */
@keyframes carousel-scroll {
    0% {
        transform: translateX(0);
    }
    100% {
        transform: translateX(-50%);
    }
}

.animate-carousel-scroll {
    animation: carousel-scroll 15s linear infinite;
}

.animate-carousel-scroll:hover {
    animation-play-state: paused;
}
    
    .active-filter {
        background-color: #175acf;
        color: #f6f7f8;
    }
    .active-filter.dark {
        color: #f6f7f8;
    }
    
    .client-item {
        opacity: 1;
        transform: scale(1);
        transition: all 0.3s ease;
    }
    
    .client-item.hidden {
        opacity: 0;
        transform: scale(0.8);
        pointer-events: none;
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
<img src="{{ asset('images/logoticomsys.png') }}" alt="TicomSys Logo" class="h-12 w-auto">
</div>
<nav class="hidden md:flex items-center gap-8">
<a class="text-sm font-medium hover:text-primary transition-colors" href="#about">Sobre Nosotros</a>
<a class="text-sm font-medium hover:text-primary transition-colors" href="#services">Servicios</a>
<a class="text-sm font-medium hover:text-primary transition-colors" href="#products">Productos</a>
<a class="text-sm font-medium hover:text-primary transition-colors" href="#clients">Clientes</a>
<a class="text-sm font-medium hover:text-primary transition-colors" href="#tech-solutions">Soluciones</a>
<a class="text-sm font-medium hover:text-primary transition-colors" href="#contact">Contacto</a>
</nav>
</div>
</div>
</header>

<!-- Hero Section -->
<main class="flex-1">
<section class="relative">
<div class="absolute inset-0 bg-gradient-to-br from-primary via-secondary to-blue-600"></div>
<div class="absolute inset-0" style="background-image: url('{{ asset('images/verne-ho-0LAJfSNa-xQ-unsplash.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;"></div>
<div class="absolute inset-0 bg-gradient-to-t from-background-dark/80 via-background-dark/40 to-background-dark/10"></div>
<div class="relative container mx-auto px-4 sm:px-6 lg:px-8">
<div class="min-h-[60vh] md:min-h-[70vh] flex flex-col items-center justify-center py-24 text-white text-center">
<div class="max-w-4xl space-y-8">
<h1 class="text-4xl md:text-6xl lg:text-7xl font-bold text-white text-shadow leading-tight">
<span class="block">Soluciones Informáticas</span>
<span class="block text-secondary">a su Servicio</span>
</h1>
<div class="flex flex-col sm:flex-row gap-4 justify-center items-center mt-8">
<button class="bg-white text-primary text-base font-semibold h-12 px-8 rounded-lg hover:bg-gray-100 transition-colors" onclick="window.location.href='#services'">
                            Nuestros Servicios
                        </button>
<button class="bg-secondary text-white text-base font-semibold h-12 px-8 rounded-lg hover:bg-blue-600 transition-colors" onclick="window.location.href='#repair'">
                            Consultar Reparación
                        </button>
</div>

</div>
</div>
</section>

<!-- About Section -->
<section id="about" class="py-20 sm:py-28">
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
<div class="max-w-6xl mx-auto">
<h2 class="text-3xl md:text-4xl font-bold tracking-tight text-center mb-12">Sobre Nosotros</h2>

<!-- Introducción -->
<div class="text-center mb-12">
<p class="text-xl text-foreground-muted-light dark:text-foreground-muted-dark leading-relaxed max-w-3xl mx-auto">
Somos una empresa nacional formada por profesionales dedicados a la búsqueda de soluciones que ayudan a mejorar las labores tecnológicas de nuestros clientes.
</p>
</div>

<!-- Timeline de la empresa -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
<!-- Historia -->
<div class="bg-white dark:bg-background-dark p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
<div class="flex items-center mb-6">
<div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center mr-4">
<span class="text-2xl font-bold text-primary">1999</span>
</div>
<h3 class="text-xl font-bold text-primary">Nuestra Historia</h3>
</div>
<p class="text-foreground-muted-light dark:text-foreground-muted-dark leading-relaxed">
Nacemos en 1999 y desde aquí nos orientamos a la venta de Equipos Tecnológicos, Soporte Técnico, Implementación de Redes de Datos y Asesorías informáticas.
</p>
</div>

<!-- Expansión -->
<div class="bg-white dark:bg-background-dark p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
<div class="flex items-center mb-6">
<div class="w-12 h-12 bg-secondary/10 rounded-lg flex items-center justify-center mr-4">
<span class="text-2xl font-bold text-secondary">2009</span>
</div>
<h3 class="text-xl font-bold text-secondary">Expansión Internacional</h3>
</div>
<p class="text-foreground-muted-light dark:text-foreground-muted-dark leading-relaxed">
En 2009 firmamos un acuerdo con la compañía DOCUMENT CONTROL SYSTEM en San Juan, Puerto Rico, para la Venta y Soporte Técnico exclusivo de la suite AQuarius Software en todo el territorio nacional, parte de Centro América, Caribe y Sur América.
</p>
</div>

<!-- Experiencia -->
<div class="bg-white dark:bg-background-dark p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
<div class="flex items-center mb-6">
<div class="w-12 h-12 bg-green-500/10 rounded-lg flex items-center justify-center mr-4">
<span class="text-2xl font-bold text-green-500">25+</span>
</div>
<h3 class="text-xl font-bold text-green-500">Experiencia Actual</h3>
</div>
<p class="text-foreground-muted-light dark:text-foreground-muted-dark leading-relaxed">
Actualmente contamos con personal profesional con más de 25 años de experiencia en el área de Soluciones Informáticas y Soluciones Documentales.
</p>
</div>
</div>
</div>
</div>
</section>

<!-- Services Section -->
<section id="services" class="bg-background-light/50 dark:bg-background-dark/50 py-20 sm:py-28">
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
<div class="text-center mb-12">
<h2 class="text-3xl md:text-4xl font-bold tracking-tight">Lo que Ofrecemos</h2>
<p class="text-lg text-foreground-muted-light dark:text-foreground-muted-dark mt-4">Servicios especializados en tecnología y gestión documental</p>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
<!-- Servicio 1 -->
<div class="flex flex-col gap-4 group bg-white dark:bg-background-dark p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
<div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center">
<img src="{{ asset('images/Aquarius.png') }}" alt="AQuarius Logo" class="w-8 h-8 object-contain">
</div>
<div>
<h3 class="text-lg font-bold">Suite AQuarius Software</h3>
<p class="text-sm text-foreground-muted-light dark:text-foreground-muted-dark mt-2">
Venta y Soporte Técnico Exclusivo a la suite AQuarius Software
</p>
</div>
</div>

<!-- Servicio 2 -->
<div class="flex flex-col gap-4 group bg-white dark:bg-background-dark p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
<div class="w-12 h-12 bg-secondary/10 rounded-lg flex items-center justify-center">
<svg class="w-6 h-6 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
</svg>
</div>
<div>
<h3 class="text-lg font-bold">Asesorías Informáticas</h3>
<p class="text-sm text-foreground-muted-light dark:text-foreground-muted-dark mt-2">
Consultoría especializada en soluciones tecnológicas para empresas
</p>
</div>
</div>

<!-- Servicio 3 -->
<div class="flex flex-col gap-4 group bg-white dark:bg-background-dark p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
<div class="w-12 h-12 bg-green-500/10 rounded-lg flex items-center justify-center">
<svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
</svg>
</div>
<div>
<h3 class="text-lg font-bold">Tratamiento Archivístico</h3>
<p class="text-sm text-foreground-muted-light dark:text-foreground-muted-dark mt-2">
Tratamiento Archivístico y Organización de Documentos (físicos y digitales)
</p>
</div>
</div>

<!-- Servicio 4 -->
<div class="flex flex-col gap-4 group bg-white dark:bg-background-dark p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
<div class="w-12 h-12 bg-blue-500/10 rounded-lg flex items-center justify-center">
<svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
</svg>
</div>
<div>
<h3 class="text-lg font-bold">Soporte Técnico</h3>
<p class="text-sm text-foreground-muted-light dark:text-foreground-muted-dark mt-2">
Soporte técnico especializado para equipos y sistemas informáticos
</p>
</div>
</div>

<!-- Servicio 5 -->
<div class="flex flex-col gap-4 group bg-white dark:bg-background-dark p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
<div class="w-12 h-12 bg-purple-500/10 rounded-lg flex items-center justify-center">
<svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2m-9 0h10m-10 0a2 2 0 00-2 2v14a2 2 0 002 2h10a2 2 0 002-2V6a2 2 0 00-2-2M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
</svg>
</div>
<div>
<h3 class="text-lg font-bold">Digitalización Masiva</h3>
<p class="text-sm text-foreground-muted-light dark:text-foreground-muted-dark mt-2">
Digitalización Masiva de Documentos (en instalaciones del cliente o en las propias: personal, equipos, software y experiencia)
</p>
</div>
</div>

<!-- Servicio 6 -->
<div class="flex flex-col gap-4 group bg-white dark:bg-background-dark p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
<div class="w-12 h-12 bg-red-500/10 rounded-lg flex items-center justify-center">
<svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path>
</svg>
</div>
<div>
<h3 class="text-lg font-bold">Equipos Tecnológicos</h3>
<p class="text-sm text-foreground-muted-light dark:text-foreground-muted-dark mt-2">
Venta de Equipos Tecnológicos de última generación
</p>
</div>
</div>

<!-- Servicio 7 -->
<div class="flex flex-col gap-4 group bg-white dark:bg-background-dark p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
<div class="w-12 h-12 bg-yellow-500/10 rounded-lg flex items-center justify-center">
<svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
</svg>
</div>
<div>
<h3 class="text-lg font-bold">Entrenamientos</h3>
<p class="text-sm text-foreground-muted-light dark:text-foreground-muted-dark mt-2">
Entrenamientos sobre Digitalización y Organización Documental
</p>
</div>
</div>

<!-- Servicio 8 -->
<div class="flex flex-col gap-4 group bg-white dark:bg-background-dark p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
<div class="w-12 h-12 bg-indigo-500/10 rounded-lg flex items-center justify-center">
<svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
</svg>
</div>
<div>
<h3 class="text-lg font-bold">Escáneres Alto Volumen</h3>
<p class="text-sm text-foreground-muted-light dark:text-foreground-muted-dark mt-2">
Venta y Soporte Técnico a Escáneres de Alto Volumen para manejo de documentos
</p>
</div>
</div>

<!-- Servicio 9 -->
<div class="flex flex-col gap-4 group bg-white dark:bg-background-dark p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
<div class="w-12 h-12 bg-teal-500/10 rounded-lg flex items-center justify-center">
<svg class="w-6 h-6 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
</svg>
</div>
<div>
<h3 class="text-lg font-bold">Acuerdos de Servicios</h3>
<p class="text-sm text-foreground-muted-light dark:text-foreground-muted-dark mt-2">
Acuerdos de Servicios Técnicos especializados
</p>
</div>
</div>

<!-- Servicio 10 -->
<div class="flex flex-col gap-4 group bg-white dark:bg-background-dark p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
<div class="w-12 h-12 bg-orange-500/10 rounded-lg flex items-center justify-center">
<svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
</svg>
</div>
<div>
<h3 class="text-lg font-bold">Inventario Local</h3>
<p class="text-sm text-foreground-muted-light dark:text-foreground-muted-dark mt-2">
Inventario Local de Recursos Técnicos y Desarrolladores
</p>
</div>
</div>
</div>
</div>
</section>

<!-- Products Section -->
<section id="products" class="py-20 sm:py-28 bg-gray-50 dark:bg-gray-900">
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
<div class="max-w-7xl mx-auto">
<!-- Header -->
<div class="text-center mb-16">
<h2 class="text-3xl md:text-4xl font-bold tracking-tight text-gray-900 dark:text-white mb-6">
Productos
</h2>
<p class="text-lg text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
Para la solución de Digitalización Masiva de Documentos, nuestro producto principal es la Suite AQuarius Software
</p>
</div>

<!-- AQuarius Overview -->
<div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8 mb-12">
<div class="flex flex-col lg:flex-row items-center gap-8">
<div class="lg:w-1/2">
<img src="{{ asset('images/Aquarius.png') }}" alt="AQuarius Software" class="w-32 h-32 mx-auto lg:mx-0 mb-6 lg:mb-0">
</div>
<div class="lg:w-1/2">
<h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
Suite AQuarius Software
</h3>
<p class="text-gray-600 dark:text-gray-300 mb-6">
Una solución orientada exclusivamente al manejo de documentos digitales en las empresas, contribuyendo así al ahorro de papel impreso y de esta forma a la preservación del medio ambiente.
</p>
<div class="grid grid-cols-2 gap-4 text-sm">
<div class="flex items-center gap-2">
<svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
</svg>
<span class="text-gray-600 dark:text-gray-300">Digitalización Masiva</span>
</div>
<div class="flex items-center gap-2">
<svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
</svg>
<span class="text-gray-600 dark:text-gray-300">Gestión Electrónica</span>
</div>
<div class="flex items-center gap-2">
<svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
</svg>
<span class="text-gray-600 dark:text-gray-300">Seguridad Avanzada</span>
</div>
<div class="flex items-center gap-2">
<svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
</svg>
<span class="text-gray-600 dark:text-gray-300">Acceso 24/7</span>
</div>
</div>
</div>
</div>
</div>

<!-- Detailed Description -->
<div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8 mb-12">
<h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
Proceso de Digitalización con AQuarius
</h3>
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
<div>
<p class="text-gray-600 dark:text-gray-300 mb-4">
Con AQuarius podemos tomar todos los archivos físicos de su empresa, digitalizarlos a través de escáneres de alta velocidad o producción, crear una aplicación personalizada para cada cliente, agregarles los índices para la posterior búsqueda de los mismos y ponerlos a disposición de los clientes de la empresa tanto interno como externo a través de intranet e internet.
</p>
<p class="text-gray-600 dark:text-gray-300 mb-4">
Protegemos sus datos a través de un poderoso módulo de seguridad, el cual puede ser totalmente personalizado para la asignación y monitoreo de privilegio a los usuarios del mismo, con lo cual logramos saber en cualquier momento quien hizo que con los documentos de la empresa.
</p>
</div>
<div>
<p class="text-gray-600 dark:text-gray-300 mb-4">
El proceso de digitalización permite convertir documentos físicos (en papel) a imágenes electrónicas, las cuales son almacenadas en un medio electrónico que permite posteriormente ser localizadas en segundos, incluso por varias personas al mismo tiempo, sin el riesgo de perder o deteriorar los documentos.
</p>
<p class="text-gray-600 dark:text-gray-300">
AQuarius permite a la gerencia de la empresa, las organizaciones y a las áreas operativas, obtener información de los diferentes documentos involucrados en un proceso administrativo.
</p>
</div>
</div>
</div>

<!-- Modules Grid -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
<!-- WebScan / AQWeb / AQIndex -->
<div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow">
<div class="flex items-center gap-4 mb-4">
<div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
<svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
</svg>
</div>
<h4 class="text-xl font-semibold text-gray-900 dark:text-white">WebScan / AQWeb / AQIndex</h4>
</div>
<p class="text-gray-600 dark:text-gray-300 mb-4">
Módulos con los que podemos tomar sus documentos, escanearlos, cargarlos e indexarlos en cualquier formato de imagen editable, hacerles OCR y cargar los datos de índices de forma automática mediante etiquetas programadas según levantamiento de OCR.
</p>
<ul class="space-y-2 text-sm text-gray-600 dark:text-gray-300">
<li class="flex items-center gap-2">
<svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
</svg>
Acceso web desde cualquier lugar
</li>
<li class="flex items-center gap-2">
<svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
</svg>
Disponible 24/7
</li>
<li class="flex items-center gap-2">
<svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
</svg>
Solo necesita navegador web
</li>
</ul>
</div>

<!-- AQuarius DMS -->
<div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow">
<div class="flex items-center gap-4 mb-4">
<div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center">
<svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
</svg>
</div>
<h4 class="text-xl font-semibold text-gray-900 dark:text-white">AQuarius DMS</h4>
</div>
<p class="text-gray-600 dark:text-gray-300 mb-4">
Document Management Software para el manejo de los documentos, permite capturar los documentos desde diversas fuentes, almacenarlos en medios electrónicos y permite que los usuarios los recuperen desde sus computadoras.
</p>
<ul class="space-y-2 text-sm text-gray-600 dark:text-gray-300">
<li class="flex items-center gap-2">
<svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
</svg>
Controlar y procesar documentos
</li>
<li class="flex items-center gap-2">
<svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
</svg>
Almacenar e indexar
</li>
<li class="flex items-center gap-2">
<svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
</svg>
Consultar y hacer anotaciones
</li>
</ul>
</div>

<!-- AQuarius Cloud -->
<div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow">
<div class="flex items-center gap-4 mb-4">
<div class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center">
<svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"></path>
</svg>
</div>
<h4 class="text-xl font-semibold text-gray-900 dark:text-white">AQuarius Cloud</h4>
</div>
<p class="text-gray-600 dark:text-gray-300 mb-4">
Módulo especializado que permite digitalizar sus documentos localmente y almacenarlos en línea en servidores de TICOMSYS y AQuarius Software para tenerlos accesibles desde cualquier lugar.
</p>
<ul class="space-y-2 text-sm text-gray-600 dark:text-gray-300">
<li class="flex items-center gap-2">
<svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
</svg>
Digitalización local
</li>
<li class="flex items-center gap-2">
<svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
</svg>
Almacenamiento en la nube
</li>
<li class="flex items-center gap-2">
<svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
</svg>
Sin inversión en equipos terceros
</li>
</ul>
</div>
</div>

<!-- Integration Section -->
<div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8 text-center">
<h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
Integración con Sistemas Existentes
</h3>
<p class="text-gray-600 dark:text-gray-300 mb-6 max-w-3xl mx-auto">
AQuarius puede integrarse con bases de datos como SQL Server, Oracle, entre otras, así como con los sistemas ERP, CRM o cualquier aplicación de negocios instalados en su institución.
</p>
<div class="flex flex-wrap justify-center gap-4">
<span class="px-4 py-2 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 rounded-full text-sm font-medium">SQL Server</span>
<span class="px-4 py-2 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-full text-sm font-medium">Oracle</span>
<span class="px-4 py-2 bg-purple-100 dark:bg-purple-900 text-purple-800 dark:text-purple-200 rounded-full text-sm font-medium">ERP</span>
<span class="px-4 py-2 bg-orange-100 dark:bg-orange-900 text-orange-800 dark:text-orange-200 rounded-full text-sm font-medium">CRM</span>
<span class="px-4 py-2 bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 rounded-full text-sm font-medium">Aplicaciones de Negocio</span>
</div>
</div>

<!-- CTA -->
<div class="text-center mt-12">
<a href="#contact" class="inline-flex items-center px-8 py-3 bg-primary text-white font-semibold rounded-lg hover:bg-primary/90 transition-colors shadow-lg hover:shadow-xl">
<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
</svg>
Solicitar Información
</a>
</div>
</div>
</div>
</section>

<!-- Clients Section -->
<section id="clients" class="py-16 md:py-24 bg-background-light dark:bg-background-dark">
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
<div class="text-center">
<h2 class="text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white sm:text-4xl">Nuestros Clientes</h2>
<p class="mt-4 max-w-2xl mx-auto text-lg text-gray-500 dark:text-gray-400">
Con nuestra división de Tratamiento Archivístico, Organización y Digitalización Masiva de Documentos contamos con una amplia cartera de importantes clientes locales e internacionales, los cuales representan casos exitosos de implementación de las herramientas de AQuarius Software.
</p>
</div>


<!-- Clientes Destacados Grid -->
<div class="mt-12">
<div class="text-center mb-12">
<h3 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-2">Algunos de nuestros clientes más destacados</h3>
<p class="text-sm text-gray-500 dark:text-gray-400">Empresas e instituciones que confían en nuestros servicios</p>
</div>

<!-- Carousel Infinito de Clientes Destacados -->
<div class="relative overflow-hidden mb-12">
<div class="flex animate-carousel-scroll">
<!-- Primera fila de logos -->
<div class="flex items-center space-x-8 whitespace-nowrap">
<!-- Banco Central -->
<div class="flex items-center justify-center w-48 h-24 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow-lg transition-shadow p-4">
<img src="{{ asset('images/clientes-icon/bancocentral.png') }}" alt="Banco Central" class="h-12 w-auto object-contain">
</div>

<!-- Claro -->
<div class="flex items-center justify-center w-48 h-24 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow-lg transition-shadow p-4">
<img src="{{ asset('images/clientes-icon/claro.png') }}" alt="Claro" class="h-12 w-auto object-contain">
</div>

<!-- CEMEX -->
<div class="flex items-center justify-center w-48 h-24 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow-lg transition-shadow p-4">
<img src="{{ asset('images/clientes-icon/cemex.png') }}" alt="CEMEX" class="h-12 w-auto object-contain">
</div>

<!-- Nestlé -->
<div class="flex items-center justify-center w-48 h-24 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow-lg transition-shadow p-4">
<img src="{{ asset('images/clientes-icon/Nestle.png') }}" alt="Nestlé" class="h-12 w-auto object-contain">
</div>

<!-- INAPA -->
<div class="flex items-center justify-center w-48 h-24 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow-lg transition-shadow p-4">
<img src="{{ asset('images/clientes-icon/INAPA.png') }}" alt="INAPA" class="h-12 w-auto object-contain">
</div>

<!-- Fuerzas Armadas -->
<div class="flex items-center justify-center w-48 h-24 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow-lg transition-shadow p-4">
<img src="{{ asset('images/clientes-icon/fuerzasarmadas.png') }}" alt="Fuerzas Armadas" class="h-12 w-auto object-contain">
</div>

<!-- Impuestos Internos -->
<div class="flex items-center justify-center w-48 h-24 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow-lg transition-shadow p-4">
<img src="{{ asset('images/clientes-icon/impuestosinternos.png') }}" alt="Impuestos Internos" class="h-12 w-auto object-contain">
</div>

<!-- Lotería Nacional -->
<div class="flex items-center justify-center w-48 h-24 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow-lg transition-shadow p-4">
<img src="{{ asset('images/clientes-icon/logo_loteria_nacional.jpg') }}" alt="Lotería Nacional" class="h-12 w-auto object-contain">
</div>

<!-- Propagas -->
<div class="flex items-center justify-center w-48 h-24 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow-lg transition-shadow p-4">
<img src="{{ asset('images/clientes-icon/propagas.png') }}" alt="Propagas" class="h-12 w-auto object-contain">
</div>

<!-- Total -->
<div class="flex items-center justify-center w-48 h-24 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow-lg transition-shadow p-4">
<img src="{{ asset('images/clientes-icon/Total.png') }}" alt="Total" class="h-12 w-auto object-contain">
</div>

<!-- VEnergy -->
<div class="flex items-center justify-center w-48 h-24 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow-lg transition-shadow p-4">
<img src="{{ asset('images/clientes-icon/VEnergy.png') }}" alt="VEnergy" class="h-12 w-auto object-contain">
</div>

<!-- Rica -->
<div class="flex items-center justify-center w-48 h-24 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow-lg transition-shadow p-4">
<img src="{{ asset('images/clientes-icon/Rica.png') }}" alt="Rica" class="h-12 w-auto object-contain">
</div>

<!-- Duplicar para efecto continuo -->
<div class="flex items-center justify-center w-48 h-24 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow-lg transition-shadow p-4">
<img src="{{ asset('images/clientes-icon/bancocentral.png') }}" alt="Banco Central" class="h-12 w-auto object-contain">
</div>

<div class="flex items-center justify-center w-48 h-24 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow-lg transition-shadow p-4">
<img src="{{ asset('images/clientes-icon/claro.png') }}" alt="Claro" class="h-12 w-auto object-contain">
</div>

<div class="flex items-center justify-center w-48 h-24 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow-lg transition-shadow p-4">
<img src="{{ asset('images/clientes-icon/cemex.png') }}" alt="CEMEX" class="h-12 w-auto object-contain">
</div>

<div class="flex items-center justify-center w-48 h-24 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow-lg transition-shadow p-4">
<img src="{{ asset('images/clientes-icon/Nestle.png') }}" alt="Nestlé" class="h-12 w-auto object-contain">
</div>

<div class="flex items-center justify-center w-48 h-24 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow-lg transition-shadow p-4">
<img src="{{ asset('images/clientes-icon/INAPA.png') }}" alt="INAPA" class="h-12 w-auto object-contain">
</div>

<div class="flex items-center justify-center w-48 h-24 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow-lg transition-shadow p-4">
<img src="{{ asset('images/clientes-icon/fuerzasarmadas.png') }}" alt="Fuerzas Armadas" class="h-12 w-auto object-contain">
</div>

<div class="flex items-center justify-center w-48 h-24 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow-lg transition-shadow p-4">
<img src="{{ asset('images/clientes-icon/impuestosinternos.png') }}" alt="Impuestos Internos" class="h-12 w-auto object-contain">
</div>

<div class="flex items-center justify-center w-48 h-24 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow-lg transition-shadow p-4">
<img src="{{ asset('images/clientes-icon/logo_loteria_nacional.jpg') }}" alt="Lotería Nacional" class="h-12 w-auto object-contain">
</div>

<div class="flex items-center justify-center w-48 h-24 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow-lg transition-shadow p-4">
<img src="{{ asset('images/clientes-icon/propagas.png') }}" alt="Propagas" class="h-12 w-auto object-contain">
</div>

<div class="flex items-center justify-center w-48 h-24 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow-lg transition-shadow p-4">
<img src="{{ asset('images/clientes-icon/Total.png') }}" alt="Total" class="h-12 w-auto object-contain">
</div>

<div class="flex items-center justify-center w-48 h-24 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow-lg transition-shadow p-4">
<img src="{{ asset('images/clientes-icon/VEnergy.png') }}" alt="VEnergy" class="h-12 w-auto object-contain">
</div>

<div class="flex items-center justify-center w-48 h-24 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow-lg transition-shadow p-4">
<img src="{{ asset('images/clientes-icon/Rica.png') }}" alt="Rica" class="h-12 w-auto object-contain">
</div>
</div>
</div>

<!-- Pause on hover effect -->
<div class="absolute inset-0 bg-transparent" onmouseover="document.querySelector('.animate-carousel-scroll').style.animationPlayState='paused'" onmouseout="document.querySelector('.animate-carousel-scroll').style.animationPlayState='running'"></div>
</div>
</div>

<!-- Ver todos button -->
<div class="text-center mt-8">
<button onclick="openAllClientsModal()" class="inline-flex items-center px-6 py-3 bg-primary text-white font-semibold rounded-lg hover:bg-primary/90 transition-colors shadow-lg hover:shadow-xl">
<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
</svg>
Ver todos nuestros clientes
</button>
<p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Más de 50 empresas e instituciones confían en nosotros</p>
</div>
</div>


<!-- Soluciones Tecnológicas Empresariales Section -->
<section id="tech-solutions" class="py-20 sm:py-28 bg-gray-50 dark:bg-gray-900">
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
<div class="text-center mb-12">
<h2 class="text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white sm:text-4xl">
Soluciones Tecnológicas Empresariales
</h2>
<p class="mt-4 max-w-2xl mx-auto text-lg text-gray-500 dark:text-gray-400">
Respecto a nuestras Soluciones Tecnológicas Empresariales ofrecemos soluciones de los siguientes socios comerciales.
</p>
</div>

<!-- Partners Grid -->
<div class="grid grid-cols-2 gap-6 sm:grid-cols-3 md:grid-cols-6 lg:gap-8">
<!-- Microsoft -->
<div class="group relative flex h-32 items-center justify-center rounded-lg bg-white dark:bg-gray-800/50 p-6 shadow-sm hover:shadow-lg transition-shadow">
<div class="w-full h-full flex items-center justify-center">
<img src="{{ asset('images/icon/pngimg.com - microsoft_PNG14.png') }}" alt="Microsoft" class="w-20 h-20 object-contain">
</div>
<div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 rounded-lg transition-all duration-300"></div>
<div class="absolute bottom-2 left-2 right-2 text-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 px-2 py-1 rounded">Microsoft</span>
</div>
</div>

<!-- HP -->
<div class="group relative flex h-32 items-center justify-center rounded-lg bg-white dark:bg-gray-800/50 p-6 shadow-sm hover:shadow-lg transition-shadow">
<div class="w-full h-full flex items-center justify-center">
<img src="{{ asset('images/icon/2048px-HP_logo_2012.svg.png') }}" alt="HP" class="w-20 h-20 object-contain">
</div>
<div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 rounded-lg transition-all duration-300"></div>
<div class="absolute bottom-2 left-2 right-2 text-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 px-2 py-1 rounded">HP</span>
</div>
</div>

<!-- Dell -->
<div class="group relative flex h-32 items-center justify-center rounded-lg bg-white dark:bg-gray-800/50 p-6 shadow-sm hover:shadow-lg transition-shadow">
<div class="w-full h-full flex items-center justify-center">
<img src="{{ asset('images/icon/dell-icon-9.png') }}" alt="Dell" class="w-20 h-20 object-contain">
</div>
<div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 rounded-lg transition-all duration-300"></div>
<div class="absolute bottom-2 left-2 right-2 text-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 px-2 py-1 rounded">Dell</span>
</div>
</div>

<!-- Canon -->
<div class="group relative flex h-32 items-center justify-center rounded-lg bg-white dark:bg-gray-800/50 p-6 shadow-sm hover:shadow-lg transition-shadow">
<div class="w-full h-full flex items-center justify-center">
<img src="{{ asset('images/icon/canon-logo-canon-icon-free-free-vector.jpg') }}" alt="Canon" class="w-20 h-20 object-contain">
</div>
<div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 rounded-lg transition-all duration-300"></div>
<div class="absolute bottom-2 left-2 right-2 text-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 px-2 py-1 rounded">Canon</span>
</div>
</div>

<!-- Epson -->
<div class="group relative flex h-32 items-center justify-center rounded-lg bg-white dark:bg-gray-800/50 p-6 shadow-sm hover:shadow-lg transition-shadow">
<div class="w-full h-full flex items-center justify-center">
<img src="{{ asset('images/icon/logo-epson-gran-empresa-brand-png-favpng-Q8XWDFKQeZTgwQ9ya5Z9ZnxXw.jpg') }}" alt="Epson" class="w-20 h-20 object-contain">
</div>
<div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 rounded-lg transition-all duration-300"></div>
<div class="absolute bottom-2 left-2 right-2 text-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 px-2 py-1 rounded">Epson</span>
</div>
</div>

<!-- APC -->
<div class="group relative flex h-32 items-center justify-center rounded-lg bg-white dark:bg-gray-800/50 p-6 shadow-sm hover:shadow-lg transition-shadow">
<div class="w-full h-full flex items-center justify-center">
<img src="{{ asset('images/icon/APC-Emblem.jpg') }}" alt="APC" class="w-20 h-20 object-contain">
</div>
<div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 rounded-lg transition-all duration-300"></div>
<div class="absolute bottom-2 left-2 right-2 text-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 px-2 py-1 rounded">APC</span>
</div>
</div>

<!-- Fujitsu -->
<div class="group relative flex h-32 items-center justify-center rounded-lg bg-white dark:bg-gray-800/50 p-6 shadow-sm hover:shadow-lg transition-shadow">
<div class="w-full h-full flex items-center justify-center">
<img src="{{ asset('images/icon/Fujitsu-Logo.svg.png') }}" alt="Fujitsu" class="w-20 h-20 object-contain">
</div>
<div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 rounded-lg transition-all duration-300"></div>
<div class="absolute bottom-2 left-2 right-2 text-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 px-2 py-1 rounded">Fujitsu</span>
</div>
</div>

<!-- Grandstream -->
<div class="group relative flex h-32 items-center justify-center rounded-lg bg-white dark:bg-gray-800/50 p-6 shadow-sm hover:shadow-lg transition-shadow">
<div class="w-full h-full flex items-center justify-center">
<img src="{{ asset('images/icon/Grandstream-Logo-2018.png') }}" alt="Grandstream" class="w-20 h-20 object-contain">
</div>
<div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 rounded-lg transition-all duration-300"></div>
<div class="absolute bottom-2 left-2 right-2 text-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 px-2 py-1 rounded">Grandstream</span>
</div>
</div>

<!-- Kodak -->
<div class="group relative flex h-32 items-center justify-center rounded-lg bg-white dark:bg-gray-800/50 p-6 shadow-sm hover:shadow-lg transition-shadow">
<div class="w-full h-full flex items-center justify-center">
<img src="{{ asset('images/icon/kodak-logo.jpg') }}" alt="Kodak" class="w-20 h-20 object-contain">
</div>
<div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 rounded-lg transition-all duration-300"></div>
<div class="absolute bottom-2 left-2 right-2 text-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 px-2 py-1 rounded">Kodak</span>
</div>
</div>

<!-- Nexxt Solutions -->
<div class="group relative flex h-32 items-center justify-center rounded-lg bg-white dark:bg-gray-800/50 p-6 shadow-sm hover:shadow-lg transition-shadow">
<div class="w-full h-full flex items-center justify-center">
<img src="{{ asset('images/icon/nexxt-solutions-logo-png_seeklogo-223159.png') }}" alt="Nexxt Solutions" class="w-20 h-20 object-contain">
</div>
<div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 rounded-lg transition-all duration-300"></div>
<div class="absolute bottom-2 left-2 right-2 text-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 px-2 py-1 rounded">Nexxt Solutions</span>
</div>
</div>

<!-- Norton -->
<div class="group relative flex h-32 items-center justify-center rounded-lg bg-white dark:bg-gray-800/50 p-6 shadow-sm hover:shadow-lg transition-shadow">
<div class="w-full h-full flex items-center justify-center">
<img src="{{ asset('images/icon/norton.png') }}" alt="Norton" class="w-20 h-20 object-contain">
</div>
<div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 rounded-lg transition-all duration-300"></div>
<div class="absolute bottom-2 left-2 right-2 text-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 px-2 py-1 rounded">Norton</span>
</div>
</div>
</div>

<!-- Call to Action -->
<div class="text-center mt-12">
<a href="#contact" class="inline-flex items-center px-8 py-3 bg-primary text-white font-semibold rounded-lg hover:bg-primary/90 transition-colors shadow-lg hover:shadow-xl">
<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
</svg>
Solicitar Información
</a>
<p class="text-sm text-gray-500 dark:text-gray-400 mt-3">Conectamos su empresa con las mejores soluciones tecnológicas del mercado</p>
</div>
</div>
</section>

<!-- Repair Section -->
<section id="repair" class="bg-background-light/50 dark:bg-background-dark/50 py-20 sm:py-28">
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
<div class="text-center mb-12">
<h2 class="text-3xl md:text-4xl font-bold tracking-tight">Sistema de Reparaciones</h2>
<p class="text-lg text-foreground-muted-light dark:text-foreground-muted-dark mt-4">Consulta el estado de tu reparación en tiempo real</p>
</div>
<div class="max-w-2xl mx-auto">
<div class="bg-white dark:bg-background-dark p-8 rounded-xl shadow-lg">
<div class="text-center mb-8">
<h3 class="text-2xl font-bold mb-4">Consultar Estado de Reparación</h3>
<p class="text-foreground-muted-light dark:text-foreground-muted-dark">
Ingresa el número de ticket para consultar el estado actual de tu reparación
</p>
</div>
<form id="repair-form" class="space-y-6">
<div>
<label class="block text-sm font-medium mb-2" for="ticketNumber">Número de Ticket</label>
<input id="ticketNumber" type="text" placeholder="Ej: TK-2024-001" class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent dark:bg-background-dark">
</div>
<button type="submit" class="w-full bg-primary text-white font-bold py-3 px-6 rounded-lg hover:opacity-90 transition-opacity">
                        Consultar Estado
                    </button>
</form>
<div id="repair-result" class="mt-8 hidden">
  <div id="repair-card" class="bg-white dark:bg-background-dark p-6 rounded-xl shadow-lg">
    <div class="flex items-center justify-between mb-4">
      <div>
        <h4 class="text-xl font-bold">Estado del Equipo</h4>
        <p class="text-sm text-foreground-muted-light dark:text-foreground-muted-dark">Ticket: <span id="resTicket" class="font-semibold"></span></p>
      </div>
      <div>
        <span id="resBadge" class="inline-flex items-center px-3 py-1 rounded-lg text-white text-sm"></span>
      </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <h5 class="font-semibold mb-2">Información del Cliente</h5>
        <p class="text-sm"><span class="text-foreground-muted-light dark:text-foreground-muted-dark">Nombre:</span> <span id="resCustomer"></span></p>
      </div>
      <div>
        <h5 class="font-semibold mb-2">Equipo</h5>
        <p class="text-sm"><span class="text-foreground-muted-light dark:text-foreground-muted-dark">Tipo:</span> <span id="resType"></span></p>
        <p class="text-sm"><span class="text-foreground-muted-light dark:text-foreground-muted-dark">Marca:</span> <span id="resBrand"></span></p>
        <p class="text-sm"><span class="text-foreground-muted-light dark:text-foreground-muted-dark">Modelo:</span> <span id="resModel"></span></p>
        <p class="text-sm"><span class="text-foreground-muted-light dark:text-foreground-muted-dark">Serie:</span> <span id="resSerial"></span></p>
      </div>
    </div>
    <div class="mt-4 text-right">
      <small class="text-foreground-muted-light dark:text-foreground-muted-dark">Última actualización: <span id="resUpdatedAt"></span></small>
    </div>
  </div>
  <div id="repair-empty" class="text-center p-6 hidden">
    <p class="text-sm text-foreground-muted-light dark:text-foreground-muted-dark">No se encontró información para este ticket.</p>
  </div>
  <div id="repair-error" class="text-center p-6 hidden">
    <p class="text-sm text-red-600">Ocurrió un error al consultar el estado. Inténtalo nuevamente.</p>
  </div>
  <div id="repair-loading" class="text-center p-6 hidden">
    <p class="text-sm text-foreground-muted-light dark:text-foreground-muted-dark">Consultando estado...</p>
  </div>
  <div class="mt-2 text-center">
    <button id="refreshBtn" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors text-sm">
      <i class="mr-1">↻</i> Actualizar Estado
    </button>
    <br>
    <small class="text-foreground-muted-light dark:text-foreground-muted-dark">Haz clic en "Actualizar Estado" para ver los cambios más recientes.</small>
  </div>
  
</div>
<div class="mt-8 text-center">
<p class="text-sm text-foreground-muted-light dark:text-foreground-muted-dark">
¿No tienes un ticket? <a href="#contact" class="text-primary hover:underline">Contáctanos</a> para registrar tu equipo
</p>
</div>
</div>
</div>
</div>
</section>

<!-- Contact Section -->
<section id="contact" class="py-20 sm:py-28">
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
<div class="text-center mb-12">
<h2 class="text-3xl md:text-4xl font-bold tracking-tight">¡Contáctanos!</h2>
<p class="text-lg text-foreground-muted-light dark:text-foreground-muted-dark mt-4">Estamos aquí para ayudarte con tus necesidades tecnológicas</p>
</div>
<div class="max-w-3xl mx-auto">
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
<!-- Columna 1 -->
<div class="space-y-6">
<!-- Email -->
<div class="flex flex-col items-center text-center">
<div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center mb-3">
<svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
</svg>
</div>
<h4 class="font-bold">Email</h4>
<p class="text-sm text-foreground-muted-light dark:text-foreground-muted-dark">info@ticomsys.com</p>
</div>

<!-- WhatsApp -->
<div class="flex flex-col items-center text-center">
<div class="w-12 h-12 bg-green-500/10 rounded-lg flex items-center justify-center mb-3">
<svg class="w-6 h-6 text-green-500" fill="currentColor" viewBox="0 0 24 24">
<path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
</svg>
</div>
<h4 class="font-bold">WhatsApp</h4>
<p class="text-sm text-foreground-muted-light dark:text-foreground-muted-dark">+1 (809) 756-3290</p>
</div>
</div>

<!-- Columna 2 -->
<div class="space-y-6">
<!-- Teléfono -->
<div class="flex flex-col items-center text-center">
<div class="w-12 h-12 bg-secondary/10 rounded-lg flex items-center justify-center mb-3">
<svg class="w-6 h-6 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
</svg>
</div>
<h4 class="font-bold">Teléfono</h4>
<p class="text-sm text-foreground-muted-light dark:text-foreground-muted-dark">+1 (809) 756-3290</p>
</div>

<!-- Ubicación -->
<div class="flex flex-col items-center text-center">
<div class="w-12 h-12 bg-purple-500/10 rounded-lg flex items-center justify-center mb-3">
<svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
</svg>
</div>
<h4 class="font-bold">Ubicación</h4>
<p class="text-sm text-foreground-muted-light dark:text-foreground-muted-dark">Santo Domingo, República Dominicana</p>
</div>
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
<a class="hover:text-primary transition-colors" href="#about">Sobre Nosotros</a>
<a class="hover:text-primary transition-colors" href="#services">Servicios</a>
<a class="hover:text-primary transition-colors" href="#products">Productos</a>
<a class="hover:text-primary transition-colors" href="#repair">Reparaciones</a>
<a class="hover:text-primary transition-colors" href="#contact">Contacto</a>
</div>
<p class="text-sm text-foreground-muted-light dark:text-foreground-muted-dark">© 2025 BSolutions.Dev. Todos los derechos reservados.</p>
</div>
</div>
</footer>
</div>
</div>

<script>
// Smooth scrolling for navigation links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Carrusel pause functionality
document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.querySelector('.animate-carousel-scroll');
    if (carousel) {
        carousel.addEventListener('mouseenter', function() {
            this.style.animationPlayState = 'paused';
        });
        carousel.addEventListener('mouseleave', function() {
            this.style.animationPlayState = 'running';
        });
    }
});

// Form handling for repair status check (inline results + polling)
(function() {
    const form = document.querySelector('#repair-form');
    const resultWrap = document.getElementById('repair-result');
    const card = document.getElementById('repair-card');
    const empty = document.getElementById('repair-empty');
    const errorBox = document.getElementById('repair-error');
    const loading = document.getElementById('repair-loading');
    const resTicket = document.getElementById('resTicket');
    const resBadge = document.getElementById('resBadge');
    const resCustomer = document.getElementById('resCustomer');
    const resType = document.getElementById('resType');
    const resBrand = document.getElementById('resBrand');
    const resModel = document.getElementById('resModel');
    const resSerial = document.getElementById('resSerial');
    const resUpdatedAt = document.getElementById('resUpdatedAt');

    const statusStyles = {
        received: { bg: 'bg-gray-600', text: 'Recibido' },
        in_review: { bg: 'bg-yellow-500', text: 'En Revisión' },
        in_repair: { bg: 'bg-blue-500', text: 'En Reparación' },
        waiting_parts: { bg: 'bg-purple-500', text: 'Esperando Repuestos' },
        ready: { bg: 'bg-green-500', text: 'Listo' },
        delivered: { bg: 'bg-gray-800', text: 'Entregado' },
        cancelled: { bg: 'bg-red-600', text: 'Cancelado' }
    };

    let pollingId = null;
    let currentTicket = null;

    async function fetchStatus(ticket) {
        try {
            loading.classList.remove('hidden');
            errorBox.classList.add('hidden');
            empty.classList.add('hidden');
            card.classList.add('hidden');

            const res = await fetch(`/consulta/status/${encodeURIComponent(ticket)}/json`, {
                headers: { 'Accept': 'application/json' }
            });
            loading.classList.add('hidden');

            if (res.status === 404) {
                empty.classList.remove('hidden');
                card.classList.add('hidden');
                return;
            }
            if (!res.ok) {
                errorBox.classList.remove('hidden');
                return;
            }
            const data = await res.json();
            if (!data.found) {
                empty.classList.remove('hidden');
                card.classList.add('hidden');
                return;
            }

            // Rellenar datos
            resTicket.textContent = data.ticket_number || ticket;
            resCustomer.textContent = data.customer_name || '';
            resType.textContent = (data.equipment && data.equipment.type) || '';
            resBrand.textContent = (data.equipment && data.equipment.brand) || '';
            resModel.textContent = (data.equipment && data.equipment.model) || '';
            resSerial.textContent = (data.equipment && data.equipment.serial_number) || '';
            resUpdatedAt.textContent = data.status_updated_at ? new Date(data.status_updated_at).toLocaleString('es-MX') : '';

            const s = statusStyles[data.status] || { bg: 'bg-gray-400', text: 'Desconocido' };
            resBadge.className = `inline-flex items-center px-3 py-1 rounded-lg text-white text-sm ${s.bg}`;
            resBadge.textContent = s.text;

            empty.classList.add('hidden');
            card.classList.remove('hidden');
            resultWrap.classList.remove('hidden');
        } catch (e) {
            loading.classList.add('hidden');
            errorBox.classList.remove('hidden');
        }
    }

    function stopPolling() {
        if (pollingId) {
            clearInterval(pollingId);
            pollingId = null;
        }
    }

    function setupRefreshButton() {
        const refreshBtn = document.getElementById('refreshBtn');
        if (refreshBtn) {
            refreshBtn.addEventListener('click', function() {
                if (currentTicket) {
                    fetchStatus(currentTicket);
                }
            });
        }
    }

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const ticket = document.getElementById('ticketNumber').value.trim();
        if (!ticket) return;
        currentTicket = ticket;
        resultWrap.classList.remove('hidden');
        fetchStatus(ticket);
        stopPolling(); // Asegurar que no hay polling automático
        setupRefreshButton(); // Configurar botón manual
    });
})();

// Form handling for contact form
document.querySelector('#contact form').addEventListener('submit', function(e) {
    e.preventDefault();
    alert('Mensaje enviado correctamente. Te contactaremos pronto.');
});

</script>

<!-- Modal para mostrar todos los clientes -->
<div id="allClientsModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 overflow-y-auto">
<div class="flex items-center justify-center min-h-screen px-4 py-8">
<div class="bg-white dark:bg-gray-900 rounded-lg shadow-xl max-w-6xl w-full max-h-[90vh] overflow-hidden">
<!-- Modal Header -->
<div class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-gray-700">
<h3 class="text-2xl font-bold text-gray-900 dark:text-white">Todos Nuestros Clientes</h3>
<button onclick="closeAllClientsModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
</svg>
</button>
</div>

<!-- Modal Content -->
<div class="p-6 overflow-y-auto max-h-[calc(90vh-120px)]">
<!-- Digitalización Masiva y Tratamiento Archivístico -->
<div class="mb-8">
<h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4 flex items-center">
<svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
</svg>
Digitalización Masiva y Tratamiento Archivístico
</h4>
<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
<!-- Banco Central -->
<div class="flex flex-col items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
<img src="{{ asset('images/clientes-icon/bancocentral.png') }}" alt="Banco Central" class="h-12 w-auto object-contain mb-2">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 text-center">Banco Central</span>
</div>

<!-- Tekgraf -->
<div class="flex flex-col items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
<img src="{{ asset('images/clientes-icon/tekgraf.png') }}" alt="Tekgraf" class="h-12 w-auto object-contain mb-2">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 text-center">Tekgraf</span>
</div>

<!-- Templaris -->
<div class="flex flex-col items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
<img src="{{ asset('images/clientes-icon/templaris.png') }}" alt="Templaris" class="h-12 w-auto object-contain mb-2">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 text-center">Templaris</span>
</div>

<!-- CEMEX -->
<div class="flex flex-col items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
<img src="{{ asset('images/clientes-icon/cemex.png') }}" alt="CEMEX" class="h-12 w-auto object-contain mb-2">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 text-center">CEMEX</span>
</div>

<!-- Claro -->
<div class="flex flex-col items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
<img src="{{ asset('images/clientes-icon/claro.png') }}" alt="Claro" class="h-12 w-auto object-contain mb-2">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 text-center">Claro</span>
</div>

<!-- Tecnas -->
<div class="flex flex-col items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
<img src="{{ asset('images/clientes-icon/tecnas.png') }}" alt="Tecnas" class="h-12 w-auto object-contain mb-2">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 text-center">Tecnas</span>
</div>

<!-- Impuestos Internos -->
<div class="flex flex-col items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
<img src="{{ asset('images/clientes-icon/impuestosinternos.png') }}" alt="Impuestos Internos" class="h-12 w-auto object-contain mb-2">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 text-center">Impuestos Internos</span>
</div>

<!-- Páginas Amarillas -->
<div class="flex flex-col items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
<img src="{{ asset('images/clientes-icon/paginasamarillas.png') }}" alt="Páginas Amarillas" class="h-12 w-auto object-contain mb-2">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 text-center">Páginas Amarillas</span>
</div>

<!-- Lotería Nacional -->
<div class="flex flex-col items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
<img src="{{ asset('images/clientes-icon/logo_loteria_nacional.jpg') }}" alt="Lotería Nacional" class="h-12 w-auto object-contain mb-2">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 text-center">Lotería Nacional</span>
</div>

<!-- Cardnet -->
<div class="flex flex-col items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
<img src="{{ asset('images/clientes-icon/cardnet.png') }}" alt="Cardnet" class="h-12 w-auto object-contain mb-2">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 text-center">Cardnet</span>
</div>

<!-- JCP Abogados -->
<div class="flex flex-col items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
<img src="{{ asset('images/clientes-icon/jcpabogados.png') }}" alt="JCP Abogados" class="h-12 w-auto object-contain mb-2">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 text-center">JCP Abogados</span>
</div>

<!-- Siuben -->
<div class="flex flex-col items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
<img src="{{ asset('images/clientes-icon/siuben.png') }}" alt="Siuben" class="h-12 w-auto object-contain mb-2">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 text-center">Siuben</span>
</div>

<!-- GA -->
<div class="flex flex-col items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
<img src="{{ asset('images/clientes-icon/ga.png') }}" alt="GA" class="h-12 w-auto object-contain mb-2">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 text-center">GA</span>
</div>

<!-- INAPA -->
<div class="flex flex-col items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
<img src="{{ asset('images/clientes-icon/INAPA.png') }}" alt="INAPA" class="h-12 w-auto object-contain mb-2">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 text-center">INAPA</span>
</div>

<!-- Petronan -->
<div class="flex flex-col items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
<img src="{{ asset('images/clientes-icon/petronan.png') }}" alt="Petronan" class="h-12 w-auto object-contain mb-2">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 text-center">Petronan</span>
</div>

<!-- Propagas -->
<div class="flex flex-col items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
<img src="{{ asset('images/clientes-icon/propagas.png') }}" alt="Propagas" class="h-12 w-auto object-contain mb-2">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 text-center">Propagas</span>
</div>

<!-- Total -->
<div class="flex flex-col items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
<img src="{{ asset('images/clientes-icon/Total.png') }}" alt="Total" class="h-12 w-auto object-contain mb-2">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 text-center">Total</span>
</div>

<!-- Unioftalcata -->
<div class="flex flex-col items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
<img src="{{ asset('images/clientes-icon/unioftalcata.png') }}" alt="Unioftalcata" class="h-12 w-auto object-contain mb-2">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 text-center">Unioftalcata</span>
</div>

<!-- Aderca -->
<div class="flex flex-col items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
<img src="{{ asset('images/clientes-icon/aderca.png') }}" alt="Aderca" class="h-12 w-auto object-contain mb-2">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 text-center">Aderca</span>
</div>

<!-- Credicefi -->
<div class="flex flex-col items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
<img src="{{ asset('images/clientes-icon/credicefi.png') }}" alt="Credicefi" class="h-12 w-auto object-contain mb-2">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 text-center">Credicefi</span>
</div>

<!-- Nestlé -->
<div class="flex flex-col items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
<img src="{{ asset('images/clientes-icon/Nestle.png') }}" alt="Nestlé" class="h-12 w-auto object-contain mb-2">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 text-center">Nestlé</span>
</div>

<!-- Rica -->
<div class="flex flex-col items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
<img src="{{ asset('images/clientes-icon/Rica.png') }}" alt="Rica" class="h-12 w-auto object-contain mb-2">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 text-center">Rica</span>
</div>

<!-- Atlántica Seguros -->
<div class="flex flex-col items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
<img src="{{ asset('images/clientes-icon/Atlantica Seguros.png') }}" alt="Atlántica Seguros" class="h-12 w-auto object-contain mb-2">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 text-center">Atlántica Seguros</span>
</div>

<!-- VEnergy -->
<div class="flex flex-col items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
<img src="{{ asset('images/clientes-icon/VEnergy.png') }}" alt="VEnergy" class="h-12 w-auto object-contain mb-2">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 text-center">VEnergy</span>
</div>

<!-- Bolsa Mercado -->
<div class="flex flex-col items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
<img src="{{ asset('images/clientes-icon/bolsamercado.png') }}" alt="Bolsa Mercado" class="h-12 w-auto object-contain mb-2">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 text-center">Bolsa Mercado</span>
</div>

<!-- Futuro -->
<div class="flex flex-col items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
<img src="{{ asset('images/clientes-icon/futuro.png') }}" alt="Futuro" class="h-12 w-auto object-contain mb-2">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 text-center">Futuro</span>
</div>

<!-- Centro Laser -->
<div class="flex flex-col items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
<img src="{{ asset('images/clientes-icon/centrolaser.png') }}" alt="Centro Laser" class="h-12 w-auto object-contain mb-2">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 text-center">Centro Laser</span>
</div>

<!-- CMR -->
<div class="flex flex-col items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
<img src="{{ asset('images/clientes-icon/cmr.png') }}" alt="CMR" class="h-12 w-auto object-contain mb-2">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 text-center">CMR</span>
</div>

<!-- FH -->
<div class="flex flex-col items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
<img src="{{ asset('images/clientes-icon/fh.png') }}" alt="FH" class="h-12 w-auto object-contain mb-2">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 text-center">FH</span>
</div>

<!-- Fuerzas Armadas -->
<div class="flex flex-col items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
<img src="{{ asset('images/clientes-icon/fuerzasarmadas.png') }}" alt="Fuerzas Armadas" class="h-12 w-auto object-contain mb-2">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 text-center">Fuerzas Armadas</span>
</div>
</div>
</div>

<!-- Soluciones Tecnológicas Empresariales y Soporte Técnico -->
<div class="mb-8">
<h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4 flex items-center">
<svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
</svg>
Soluciones Tecnológicas Empresariales y Soporte Técnico
</h4>
<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
<!-- Cepeda -->
<div class="flex flex-col items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
<img src="{{ asset('images/clientes-icon/cepeda.png') }}" alt="Cepeda" class="h-12 w-auto object-contain mb-2">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 text-center">Cepeda</span>
</div>

<!-- Del Caribe -->
<div class="flex flex-col items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
<img src="{{ asset('images/clientes-icon/delcaribe.png') }}" alt="Del Caribe" class="h-12 w-auto object-contain mb-2">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 text-center">Del Caribe</span>
</div>

<!-- DF -->
<div class="flex flex-col items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
<img src="{{ asset('images/clientes-icon/df.png') }}" alt="DF" class="h-12 w-auto object-contain mb-2">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 text-center">DF</span>
</div>

<!-- Dkolor -->
<div class="flex flex-col items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
<img src="{{ asset('images/clientes-icon/dkolor.png') }}" alt="Dkolor" class="h-12 w-auto object-contain mb-2">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 text-center">Dkolor</span>
</div>

<!-- Horizon -->
<div class="flex flex-col items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
<img src="{{ asset('images/clientes-icon/horizon.png') }}" alt="Horizon" class="h-12 w-auto object-contain mb-2">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 text-center">Horizon</span>
</div>

<!-- Inversiones Celidie -->
<div class="flex flex-col items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
<img src="{{ asset('images/clientes-icon/inversionescelidie.png') }}" alt="Inversiones Celidie" class="h-12 w-auto object-contain mb-2">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 text-center">Inversiones Celidie</span>
</div>

<!-- Laboratorio Britania -->
<div class="flex flex-col items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
<img src="{{ asset('images/clientes-icon/laboratoriobritania.png') }}" alt="Laboratorio Britania" class="h-12 w-auto object-contain mb-2">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 text-center">Laboratorio Britania</span>
</div>

<!-- Laboratorio Cris Industrial -->
<div class="flex flex-col items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
<img src="{{ asset('images/clientes-icon/laboratoriocrisindustrial.png') }}" alt="Laboratorio Cris Industrial" class="h-12 w-auto object-contain mb-2">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 text-center">Laboratorio Cris Industrial</span>
</div>

<!-- Lambda -->
<div class="flex flex-col items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
<img src="{{ asset('images/clientes-icon/lamda.png') }}" alt="Lambda" class="h-12 w-auto object-contain mb-2">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 text-center">Lambda</span>
</div>

<!-- Latterale -->
<div class="flex flex-col items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
<img src="{{ asset('images/clientes-icon/latterale.png') }}" alt="Latterale" class="h-12 w-auto object-contain mb-2">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 text-center">Latterale</span>
</div>

<!-- Macro -->
<div class="flex flex-col items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
<img src="{{ asset('images/clientes-icon/macro.png') }}" alt="Macro" class="h-12 w-auto object-contain mb-2">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 text-center">Macro</span>
</div>

<!-- Medina -->
<div class="flex flex-col items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
<img src="{{ asset('images/clientes-icon/medina.png') }}" alt="Medina" class="h-12 w-auto object-contain mb-2">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 text-center">Medina</span>
</div>

<!-- Milena -->
<div class="flex flex-col items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
<img src="{{ asset('images/clientes-icon/milena.png') }}" alt="Milena" class="h-12 w-auto object-contain mb-2">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 text-center">Milena</span>
</div>

<!-- Paulinas -->
<div class="flex flex-col items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
<img src="{{ asset('images/clientes-icon/paulinas.png') }}" alt="Paulinas" class="h-12 w-auto object-contain mb-2">
<span class="text-xs font-medium text-gray-700 dark:text-gray-300 text-center">Paulinas</span>
</div>
</div>
</div>
</div>

<!-- Modal Footer -->
<div class="flex items-center justify-end p-6 border-t border-gray-200 dark:border-gray-700">
<button onclick="closeAllClientsModal()" class="px-6 py-2 bg-primary text-white font-semibold rounded-lg hover:bg-primary/90 transition-colors">
Cerrar
</button>
</div>
</div>
</div>
</div>

<script>
function openAllClientsModal() {
    document.getElementById('allClientsModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeAllClientsModal() {
    document.getElementById('allClientsModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Cerrar modal al hacer clic fuera de él
document.getElementById('allClientsModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeAllClientsModal();
    }
});

// Cerrar modal con tecla Escape
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeAllClientsModal();
    }
});
</script>

</body>
</html>
