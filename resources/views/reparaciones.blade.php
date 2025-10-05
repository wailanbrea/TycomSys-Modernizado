<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Consultar Reparaciones - TicomSys</title>
<meta name="description" content="Consulta el estado de tu reparación en tiempo real. Sistema de seguimiento de equipos en reparación con TicomSys.">
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
<a class="text-sm font-medium hover:text-primary transition-colors" href="/software">Software</a>
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
<h1 class="text-4xl md:text-6xl font-bold mb-6">Sistema de Reparaciones</h1>
<p class="text-xl text-white/90 max-w-3xl mx-auto">
Consulta el estado de tu reparación en tiempo real. Seguimiento completo de tu equipo desde la recepción hasta la entrega.
</p>
</div>
</div>
</section>

<!-- Repair Status Section -->
<section class="py-12 sm:py-20">
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
<div class="max-w-4xl mx-auto">
<div class="bg-white dark:bg-background-dark rounded-2xl shadow-xl p-8 lg:p-12">
<div class="text-center mb-12">
<h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Consultar Estado de Reparación</h2>
<p class="text-lg text-gray-600 dark:text-gray-300">
Ingresa el número de ticket para consultar el estado actual de tu reparación
</p>
</div>

<form id="repair-form" class="space-y-6 mb-8">
<div>
<label class="block text-sm font-medium mb-3 text-gray-700 dark:text-gray-300" for="ticketNumber">Número de Ticket</label>
<input id="ticketNumber" type="text" placeholder="Ej: TK-2024-001" class="w-full px-6 py-4 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent dark:bg-gray-700 dark:text-white text-lg">
</div>
<button type="submit" class="w-full bg-primary text-white font-bold py-4 px-6 rounded-lg hover:bg-primary/90 transition-colors text-lg btn-glow">
Consultar Estado
</button>
</form>

<!-- Results Section -->
<div id="repair-result" class="hidden">
  <div id="repair-card" class="bg-gray-50 dark:bg-gray-800 p-8 rounded-xl shadow-lg">
    <div class="flex items-center justify-between mb-6">
      <div>
        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Estado del Equipo</h3>
        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Ticket: <span id="resTicket" class="font-semibold text-primary"></span></p>
      </div>
      <div>
        <span id="resBadge" class="inline-flex items-center px-4 py-2 rounded-lg text-white text-sm font-medium"></span>
      </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
      <div class="bg-white dark:bg-gray-700 p-6 rounded-lg">
        <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Información del Cliente</h4>
        <div class="space-y-2">
          <p class="text-sm"><span class="text-gray-600 dark:text-gray-400">Nombre:</span> <span id="resCustomer" class="font-medium text-gray-900 dark:text-white"></span></p>
        </div>
      </div>
      
      <div class="bg-white dark:bg-gray-700 p-6 rounded-lg">
        <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Información del Equipo</h4>
        <div class="space-y-2">
          <p class="text-sm"><span class="text-gray-600 dark:text-gray-400">Tipo:</span> <span id="resType" class="font-medium text-gray-900 dark:text-white"></span></p>
          <p class="text-sm"><span class="text-gray-600 dark:text-gray-400">Marca:</span> <span id="resBrand" class="font-medium text-gray-900 dark:text-white"></span></p>
          <p class="text-sm"><span class="text-gray-600 dark:text-gray-400">Modelo:</span> <span id="resModel" class="font-medium text-gray-900 dark:text-white"></span></p>
          <p class="text-sm"><span class="text-gray-600 dark:text-gray-400">Serie:</span> <span id="resSerial" class="font-medium text-gray-900 dark:text-white"></span></p>
        </div>
      </div>
    </div>
    
    <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-600">
      <div class="flex items-center justify-between">
        <small class="text-gray-600 dark:text-gray-400">Última actualización: <span id="resUpdatedAt" class="font-medium"></span></small>
        <button id="refreshBtn" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors text-sm font-medium">
          <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
          </svg>
          Actualizar Estado
        </button>
      </div>
    </div>
  </div>
  
  <div id="repair-empty" class="text-center p-8 hidden">
    <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-6">
      <svg class="w-12 h-12 text-yellow-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
      </svg>
      <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">No se encontró información</h3>
      <p class="text-gray-600 dark:text-gray-400">No se encontró información para este ticket. Verifica el número e intenta nuevamente.</p>
    </div>
  </div>
  
  <div id="repair-error" class="text-center p-8 hidden">
    <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-6">
      <svg class="w-12 h-12 text-red-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
      </svg>
      <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Error en la consulta</h3>
      <p class="text-gray-600 dark:text-gray-400">Ocurrió un error al consultar el estado. Inténtalo nuevamente.</p>
    </div>
  </div>
  
  <div id="repair-loading" class="text-center p-8 hidden">
    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-6">
      <svg class="w-12 h-12 text-blue-500 mx-auto mb-4 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
      </svg>
      <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Consultando estado...</h3>
      <p class="text-gray-600 dark:text-gray-400">Por favor espera mientras verificamos la información de tu ticket.</p>
    </div>
  </div>
</div>

<div class="mt-8 text-center">
<p class="text-sm text-gray-600 dark:text-gray-400">
¿No tienes un ticket? <a href="/#contact" class="text-primary hover:text-primary/80 font-medium">Contáctanos</a> para registrar tu equipo
</p>
</div>
</div>
</div>
</div>
</section>

<!-- Status Legend -->
<section class="bg-gray-50 dark:bg-gray-900 py-16">
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
<div class="max-w-4xl mx-auto">
<div class="text-center mb-12">
<h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Estados de Reparación</h2>
<p class="text-gray-600 dark:text-gray-400">Conoce el significado de cada estado en el proceso de reparación</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
<div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
<div class="flex items-center gap-3 mb-3">
<div class="w-4 h-4 bg-gray-600 rounded-full"></div>
<h3 class="font-semibold text-gray-900 dark:text-white">Recibido</h3>
</div>
<p class="text-sm text-gray-600 dark:text-gray-400">Tu equipo ha sido recibido y está en cola para evaluación.</p>
</div>

<div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
<div class="flex items-center gap-3 mb-3">
<div class="w-4 h-4 bg-yellow-500 rounded-full"></div>
<h3 class="font-semibold text-gray-900 dark:text-white">En Revisión</h3>
</div>
<p class="text-sm text-gray-600 dark:text-gray-400">Nuestros técnicos están evaluando el problema del equipo.</p>
</div>

<div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
<div class="flex items-center gap-3 mb-3">
<div class="w-4 h-4 bg-blue-500 rounded-full"></div>
<h3 class="font-semibold text-gray-900 dark:text-white">En Reparación</h3>
</div>
<p class="text-sm text-gray-600 dark:text-gray-400">El equipo está siendo reparado por nuestros técnicos especializados.</p>
</div>

<div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
<div class="flex items-center gap-3 mb-3">
<div class="w-4 h-4 bg-purple-500 rounded-full"></div>
<h3 class="font-semibold text-gray-900 dark:text-white">Esperando Repuestos</h3>
</div>
<p class="text-sm text-gray-600 dark:text-gray-400">Estamos esperando la llegada de repuestos necesarios.</p>
</div>

<div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
<div class="flex items-center gap-3 mb-3">
<div class="w-4 h-4 bg-green-500 rounded-full"></div>
<h3 class="font-semibold text-gray-900 dark:text-white">Listo</h3>
</div>
<p class="text-sm text-gray-600 dark:text-gray-400">Tu equipo está listo para ser recogido o entregado.</p>
</div>

<div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
<div class="flex items-center gap-3 mb-3">
<div class="w-4 h-4 bg-gray-800 rounded-full"></div>
<h3 class="font-semibold text-gray-900 dark:text-white">Entregado</h3>
</div>
<p class="text-sm text-gray-600 dark:text-gray-400">El equipo ha sido entregado al cliente.</p>
</div>

<div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
<div class="flex items-center gap-3 mb-3">
<div class="w-4 h-4 bg-red-600 rounded-full"></div>
<h3 class="font-semibold text-gray-900 dark:text-white">Cancelado</h3>
</div>
<p class="text-sm text-gray-600 dark:text-gray-400">La reparación ha sido cancelada por el cliente.</p>
</div>
</div>
</div>
</div>
</section>

<!-- CTA Section -->
<section class="bg-primary py-20 sm:py-28">
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
<div class="text-center text-white">
<h2 class="text-3xl md:text-4xl font-bold mb-6">¿Necesitas reparar tu equipo?</h2>
<p class="text-xl text-white/90 mb-8 max-w-2xl mx-auto">
Contáctanos para programar la reparación de tu equipo tecnológico con nuestros técnicos especializados
</p>
<div class="flex flex-col sm:flex-row gap-4 justify-center">
<a href="/#contact" class="bg-white text-primary font-semibold px-8 py-3 rounded-lg btn-glow">
Solicitar Reparación
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

<script>
// Form handling for repair status check
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
            resBadge.className = `inline-flex items-center px-4 py-2 rounded-lg text-white text-sm font-medium ${s.bg}`;
            resBadge.textContent = s.text;

            empty.classList.add('hidden');
            card.classList.remove('hidden');
            resultWrap.classList.remove('hidden');
        } catch (e) {
            loading.classList.add('hidden');
            errorBox.classList.remove('hidden');
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
        setupRefreshButton();
    });
})();
</script>

</body>
</html>
