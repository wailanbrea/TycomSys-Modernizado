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
    animation: carousel-scroll 30s linear infinite;
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
<div class="flex items-center gap-4">
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
<div class="flex items-center">
<button class="bg-primary text-white text-sm font-bold h-10 px-5 rounded-lg flex items-center justify-center hover:opacity-90 transition-opacity" onclick="window.location.href='#contact'">
                        ¡Comencémos!
                    </button>
</div>
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


<!-- Featured Clients Carousel -->
<div class="mt-12">
<div class="text-center mb-8">
<h3 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-2">Algunos de nuestros clientes más destacados</h3>
<p class="text-sm text-gray-500 dark:text-gray-400">Empresas e instituciones que confían en nuestros servicios</p>
</div>

<!-- Carousel Container -->
<div class="relative overflow-hidden">
<div class="flex animate-carousel-scroll">
<!-- Primera fila de logos -->
<div class="flex items-center space-x-8 whitespace-nowrap">
<!-- Clientes destacados -->
<div class="flex items-center justify-center w-48 h-24 bg-white dark:bg-gray-800/50 rounded-lg shadow-sm hover:shadow-lg transition-shadow p-4">
<div class="w-40 h-16 bg-gradient-to-br from-blue-500 to-blue-700 rounded flex items-center justify-center text-white font-bold text-sm px-2">Banco Central</div>
</div>

<div class="flex items-center justify-center w-48 h-24 bg-white dark:bg-gray-800/50 rounded-lg shadow-sm hover:shadow-lg transition-shadow p-4">
<div class="w-40 h-16 bg-gradient-to-br from-green-500 to-green-700 rounded flex items-center justify-center text-white font-bold text-sm px-2">Cemex</div>
</div>

<div class="flex items-center justify-center w-48 h-24 bg-white dark:bg-gray-800/50 rounded-lg shadow-sm hover:shadow-lg transition-shadow p-4">
<div class="w-40 h-16 bg-gradient-to-br from-red-500 to-red-700 rounded flex items-center justify-center text-white font-bold text-sm px-2">Claro</div>
</div>

<div class="flex items-center justify-center w-48 h-24 bg-white dark:bg-gray-800/50 rounded-lg shadow-sm hover:shadow-lg transition-shadow p-4">
<div class="w-40 h-16 bg-gradient-to-br from-gray-600 to-gray-800 rounded flex items-center justify-center text-white font-bold text-xs px-2">Impuestos Internos</div>
</div>

<div class="flex items-center justify-center w-48 h-24 bg-white dark:bg-gray-800/50 rounded-lg shadow-sm hover:shadow-lg transition-shadow p-4">
<div class="w-40 h-16 bg-gradient-to-br from-teal-500 to-teal-700 rounded flex items-center justify-center text-white font-bold text-xs px-2">Lotería Nacional</div>
</div>

<div class="flex items-center justify-center w-48 h-24 bg-white dark:bg-gray-800/50 rounded-lg shadow-sm hover:shadow-lg transition-shadow p-4">
<div class="w-40 h-16 bg-gradient-to-br from-cyan-500 to-cyan-700 rounded flex items-center justify-center text-white font-bold text-sm px-2">Cardnet</div>
</div>

<div class="flex items-center justify-center w-48 h-24 bg-white dark:bg-gray-800/50 rounded-lg shadow-sm hover:shadow-lg transition-shadow p-4">
<div class="w-40 h-16 bg-gradient-to-br from-purple-500 to-purple-700 rounded flex items-center justify-center text-white font-bold text-sm px-2">Templaris</div>
</div>

<div class="flex items-center justify-center w-48 h-24 bg-white dark:bg-gray-800/50 rounded-lg shadow-sm hover:shadow-lg transition-shadow p-4">
<div class="w-40 h-16 bg-gradient-to-br from-orange-500 to-orange-700 rounded flex items-center justify-center text-white font-bold text-sm px-2">Tekgraf</div>
</div>

<div class="flex items-center justify-center w-48 h-24 bg-white dark:bg-gray-800/50 rounded-lg shadow-sm hover:shadow-lg transition-shadow p-4">
<div class="w-40 h-16 bg-gradient-to-br from-pink-500 to-pink-700 rounded flex items-center justify-center text-white font-bold text-xs px-2">JCP Abogados</div>
</div>

<div class="flex items-center justify-center w-48 h-24 bg-white dark:bg-gray-800/50 rounded-lg shadow-sm hover:shadow-lg transition-shadow p-4">
<div class="w-40 h-16 bg-gradient-to-br from-indigo-500 to-indigo-700 rounded flex items-center justify-center text-white font-bold text-sm px-2">SGA</div>
</div>
</div>

<!-- Segunda fila duplicada para efecto infinito -->
<div class="flex items-center space-x-8 whitespace-nowrap">
<div class="flex items-center justify-center w-48 h-24 bg-white dark:bg-gray-800/50 rounded-lg shadow-sm hover:shadow-lg transition-shadow p-4">
<div class="w-40 h-16 bg-gradient-to-br from-blue-500 to-blue-700 rounded flex items-center justify-center text-white font-bold text-sm px-2">Banco Central</div>
</div>

<div class="flex items-center justify-center w-48 h-24 bg-white dark:bg-gray-800/50 rounded-lg shadow-sm hover:shadow-lg transition-shadow p-4">
<div class="w-40 h-16 bg-gradient-to-br from-green-500 to-green-700 rounded flex items-center justify-center text-white font-bold text-sm px-2">Cemex</div>
</div>

<div class="flex items-center justify-center w-48 h-24 bg-white dark:bg-gray-800/50 rounded-lg shadow-sm hover:shadow-lg transition-shadow p-4">
<div class="w-40 h-16 bg-gradient-to-br from-red-500 to-red-700 rounded flex items-center justify-center text-white font-bold text-sm px-2">Claro</div>
</div>

<div class="flex items-center justify-center w-48 h-24 bg-white dark:bg-gray-800/50 rounded-lg shadow-sm hover:shadow-lg transition-shadow p-4">
<div class="w-40 h-16 bg-gradient-to-br from-gray-600 to-gray-800 rounded flex items-center justify-center text-white font-bold text-xs px-2">Impuestos Internos</div>
</div>

<div class="flex items-center justify-center w-48 h-24 bg-white dark:bg-gray-800/50 rounded-lg shadow-sm hover:shadow-lg transition-shadow p-4">
<div class="w-40 h-16 bg-gradient-to-br from-teal-500 to-teal-700 rounded flex items-center justify-center text-white font-bold text-xs px-2">Lotería Nacional</div>
</div>

<div class="flex items-center justify-center w-48 h-24 bg-white dark:bg-gray-800/50 rounded-lg shadow-sm hover:shadow-lg transition-shadow p-4">
<div class="w-40 h-16 bg-gradient-to-br from-cyan-500 to-cyan-700 rounded flex items-center justify-center text-white font-bold text-sm px-2">Cardnet</div>
</div>

<div class="flex items-center justify-center w-48 h-24 bg-white dark:bg-gray-800/50 rounded-lg shadow-sm hover:shadow-lg transition-shadow p-4">
<div class="w-40 h-16 bg-gradient-to-br from-purple-500 to-purple-700 rounded flex items-center justify-center text-white font-bold text-sm px-2">Templaris</div>
</div>

<div class="flex items-center justify-center w-48 h-24 bg-white dark:bg-gray-800/50 rounded-lg shadow-sm hover:shadow-lg transition-shadow p-4">
<div class="w-40 h-16 bg-gradient-to-br from-orange-500 to-orange-700 rounded flex items-center justify-center text-white font-bold text-sm px-2">Tekgraf</div>
</div>

<div class="flex items-center justify-center w-48 h-24 bg-white dark:bg-gray-800/50 rounded-lg shadow-sm hover:shadow-lg transition-shadow p-4">
<div class="w-40 h-16 bg-gradient-to-br from-pink-500 to-pink-700 rounded flex items-center justify-center text-white font-bold text-xs px-2">JCP Abogados</div>
</div>

<div class="flex items-center justify-center w-48 h-24 bg-white dark:bg-gray-800/50 rounded-lg shadow-sm hover:shadow-lg transition-shadow p-4">
<div class="w-40 h-16 bg-gradient-to-br from-indigo-500 to-indigo-700 rounded flex items-center justify-center text-white font-bold text-sm px-2">SGA</div>
</div>
</div>
</div>

<!-- Pause on hover effect -->
<div class="absolute inset-0 bg-transparent" onmouseover="document.querySelector('.animate-carousel-scroll').style.animationPlayState='paused'" onmouseout="document.querySelector('.animate-carousel-scroll').style.animationPlayState='running'"></div>
</div>

<!-- Ver todos button -->
<div class="text-center mt-8">
<button onclick="openAllClientsModal()" class="inline-flex items-center px-6 py-3 bg-primary text-white font-semibold rounded-lg hover:bg-primary/90 transition-colors shadow-lg hover:shadow-xl">
<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
</svg>
Ver todos nuestros clientes
</button>
<p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Más de 40 empresas e instituciones confían en nosotros</p>
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

</div>
</div>
</section>

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
<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3">
<span class="px-3 py-2 bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-200 rounded-lg text-sm font-medium text-center">Banco Central</span>
<span class="px-3 py-2 bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-200 rounded-lg text-sm font-medium text-center">Tekgraf</span>
<span class="px-3 py-2 bg-purple-100 dark:bg-purple-900/30 text-purple-800 dark:text-purple-200 rounded-lg text-sm font-medium text-center">Templaris</span>
<span class="px-3 py-2 bg-orange-100 dark:bg-orange-900/30 text-orange-800 dark:text-orange-200 rounded-lg text-sm font-medium text-center">Cemex</span>
<span class="px-3 py-2 bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-200 rounded-lg text-sm font-medium text-center">Claro</span>
<span class="px-3 py-2 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-800 dark:text-indigo-200 rounded-lg text-sm font-medium text-center">Tecnas</span>
<span class="px-3 py-2 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-lg text-sm font-medium text-center">Impuestos Internos</span>
<span class="px-3 py-2 bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-200 rounded-lg text-sm font-medium text-center">Páginas Amarillas</span>
<span class="px-3 py-2 bg-teal-100 dark:bg-teal-900/30 text-teal-800 dark:text-teal-200 rounded-lg text-sm font-medium text-center">Lotería Nacional</span>
<span class="px-3 py-2 bg-cyan-100 dark:bg-cyan-900/30 text-cyan-800 dark:text-cyan-200 rounded-lg text-sm font-medium text-center">Cardnet</span>
<span class="px-3 py-2 bg-pink-100 dark:bg-pink-900/30 text-pink-800 dark:text-pink-200 rounded-lg text-sm font-medium text-center">JCP Abogados</span>
<span class="px-3 py-2 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-800 dark:text-emerald-200 rounded-lg text-sm font-medium text-center">Siuben</span>
<span class="px-3 py-2 bg-violet-100 dark:bg-violet-900/30 text-violet-800 dark:text-violet-200 rounded-lg text-sm font-medium text-center">GA</span>
<span class="px-3 py-2 bg-slate-100 dark:bg-slate-700 text-slate-800 dark:text-slate-200 rounded-lg text-sm font-medium text-center">INAPA</span>
<span class="px-3 py-2 bg-rose-100 dark:bg-rose-900/30 text-rose-800 dark:text-rose-200 rounded-lg text-sm font-medium text-center">Petronan</span>
<span class="px-3 py-2 bg-lime-100 dark:bg-lime-900/30 text-lime-800 dark:text-lime-200 rounded-lg text-sm font-medium text-center">Propagas</span>
<span class="px-3 py-2 bg-sky-100 dark:bg-sky-900/30 text-sky-800 dark:text-sky-200 rounded-lg text-sm font-medium text-center">Total</span>
<span class="px-3 py-2 bg-fuchsia-100 dark:bg-fuchsia-900/30 text-fuchsia-800 dark:text-fuchsia-200 rounded-lg text-sm font-medium text-center">Unioftal</span>
<span class="px-3 py-2 bg-amber-100 dark:bg-amber-900/30 text-amber-800 dark:text-amber-200 rounded-lg text-sm font-medium text-center">Cata</span>
<span class="px-3 py-2 bg-stone-100 dark:bg-stone-700 text-stone-800 dark:text-stone-200 rounded-lg text-sm font-medium text-center">Aderca</span>
<span class="px-3 py-2 bg-zinc-100 dark:bg-zinc-700 text-zinc-800 dark:text-zinc-200 rounded-lg text-sm font-medium text-center">Credicefi</span>
<span class="px-3 py-2 bg-neutral-100 dark:bg-neutral-700 text-neutral-800 dark:text-neutral-200 rounded-lg text-sm font-medium text-center">Nestlé</span>
<span class="px-3 py-2 bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-200 rounded-lg text-sm font-medium text-center">Rica</span>
<span class="px-3 py-2 bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-200 rounded-lg text-sm font-medium text-center">Atlántica</span>
<span class="px-3 py-2 bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-200 rounded-lg text-sm font-medium text-center">Seguros</span>
<span class="px-3 py-2 bg-purple-100 dark:bg-purple-900/30 text-purple-800 dark:text-purple-200 rounded-lg text-sm font-medium text-center">VEnergy</span>
<span class="px-3 py-2 bg-orange-100 dark:bg-orange-900/30 text-orange-800 dark:text-orange-200 rounded-lg text-sm font-medium text-center">Bolsa</span>
<span class="px-3 py-2 bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-200 rounded-lg text-sm font-medium text-center">Mercado Futuro</span>
<span class="px-3 py-2 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-800 dark:text-indigo-200 rounded-lg text-sm font-medium text-center">Centro Láser</span>
<span class="px-3 py-2 bg-teal-100 dark:bg-teal-900/30 text-teal-800 dark:text-teal-200 rounded-lg text-sm font-medium text-center">CMR</span>
<span class="px-3 py-2 bg-cyan-100 dark:bg-cyan-900/30 text-cyan-800 dark:text-cyan-200 rounded-lg text-sm font-medium text-center">FH</span>
<span class="px-3 py-2 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-lg text-sm font-medium text-center">Fuerzas Armadas</span>
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
<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3">
<span class="px-3 py-2 bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-200 rounded-lg text-sm font-medium text-center">Cepeda Del Caribe</span>
<span class="px-3 py-2 bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-200 rounded-lg text-sm font-medium text-center">DF</span>
<span class="px-3 py-2 bg-purple-100 dark:bg-purple-900/30 text-purple-800 dark:text-purple-200 rounded-lg text-sm font-medium text-center">DKolor</span>
<span class="px-3 py-2 bg-orange-100 dark:bg-orange-900/30 text-orange-800 dark:text-orange-200 rounded-lg text-sm font-medium text-center">Horizon</span>
<span class="px-3 py-2 bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-200 rounded-lg text-sm font-medium text-center">Inversiones Celidie</span>
<span class="px-3 py-2 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-800 dark:text-indigo-200 rounded-lg text-sm font-medium text-center">Laboratorio Britania</span>
<span class="px-3 py-2 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-lg text-sm font-medium text-center">Laboratorio Cris Industrial</span>
<span class="px-3 py-2 bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-200 rounded-lg text-sm font-medium text-center">Lamda</span>
<span class="px-3 py-2 bg-teal-100 dark:bg-teal-900/30 text-teal-800 dark:text-teal-200 rounded-lg text-sm font-medium text-center">Latterale</span>
<span class="px-3 py-2 bg-cyan-100 dark:bg-cyan-900/30 text-cyan-800 dark:text-cyan-200 rounded-lg text-sm font-medium text-center">Macro</span>
<span class="px-3 py-2 bg-pink-100 dark:bg-pink-900/30 text-pink-800 dark:text-pink-200 rounded-lg text-sm font-medium text-center">Medina</span>
<span class="px-3 py-2 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-800 dark:text-emerald-200 rounded-lg text-sm font-medium text-center">Milena</span>
<span class="px-3 py-2 bg-violet-100 dark:bg-violet-900/30 text-violet-800 dark:text-violet-200 rounded-lg text-sm font-medium text-center">Pagord</span>
<span class="px-3 py-2 bg-slate-100 dark:bg-slate-700 text-slate-800 dark:text-slate-200 rounded-lg text-sm font-medium text-center">Paulinas</span>
<span class="px-3 py-2 bg-rose-100 dark:bg-rose-900/30 text-rose-800 dark:text-rose-200 rounded-lg text-sm font-medium text-center">Quiroz</span>
<span class="px-3 py-2 bg-lime-100 dark:bg-lime-900/30 text-lime-800 dark:text-lime-200 rounded-lg text-sm font-medium text-center">SGA</span>
<span class="px-3 py-2 bg-sky-100 dark:bg-sky-900/30 text-sky-800 dark:text-sky-200 rounded-lg text-sm font-medium text-center">Susaeta</span>
<span class="px-3 py-2 bg-fuchsia-100 dark:bg-fuchsia-900/30 text-fuchsia-800 dark:text-fuchsia-200 rounded-lg text-sm font-medium text-center">Banco Central</span>
<span class="px-3 py-2 bg-amber-100 dark:bg-amber-900/30 text-amber-800 dark:text-amber-200 rounded-lg text-sm font-medium text-center">Tekgraf</span>
<span class="px-3 py-2 bg-stone-100 dark:bg-stone-700 text-stone-800 dark:text-stone-200 rounded-lg text-sm font-medium text-center">Templaris</span>
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
