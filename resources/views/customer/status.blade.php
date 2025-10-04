<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>TicomSys - Estado del Equipo {{ $equipment->ticket_number }}</title>
<meta name="description" content="Estado actual de tu equipo en reparación">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
<link href="https://demos.creative-tim.com/argon-dashboard/assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
<link href="https://demos.creative-tim.com/argon-dashboard/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
<link href="https://demos.creative-tim.com/argon-dashboard/assets/css/argon-dashboard.min.css?v=1.1.0" rel="stylesheet">
<style>
  .bg-gradient-primary {
    background: linear-gradient(87deg, #5e72e4 0, #825ee4 100%) !important;
  }
  .status-badge {
    font-size: 1.1rem;
    padding: 0.5rem 1rem;
  }
  .timeline-item {
    position: relative;
    padding-left: 2rem;
    margin-bottom: 1.5rem;
  }
  .timeline-item::before {
    content: '';
    position: absolute;
    left: 0.5rem;
    top: 0.5rem;
    width: 0.75rem;
    height: 0.75rem;
    border-radius: 50%;
    background-color: #5e72e4;
  }
  .timeline-item::after {
    content: '';
    position: absolute;
    left: 0.875rem;
    top: 1.25rem;
    width: 2px;
    height: calc(100% + 0.5rem);
    background-color: #e9ecef;
  }
  .timeline-item:last-child::after {
    display: none;
  }
</style>
</head>
<body class="bg-default">
<!-- Main content -->
<div class="main-content">
  <!-- Header -->
  <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
    <div class="container">
      <div class="header-body text-center mb-7">
        <div class="row justify-content-center">
          <div class="col-xl-8 col-lg-10 col-md-12 px-5">
            <div class="card bg-secondary shadow border-0">
              <div class="card-header bg-white pb-5">
                <div class="text-muted text-center mb-3">
                  <img src="{{ asset('images/logoticomsys.png') }}" alt="TicomSys Logo" class="img-fluid" style="max-height: 60px;">
                </div>
                <div class="text-center">
                  <h1 class="display-4 text-muted">Estado del Equipo</h1>
                  <p class="text-muted">Ticket: <strong>{{ $equipment->ticket_number }}</strong></p>
                </div>
              </div>
              <div class="card-body px-lg-5 py-lg-5">
                <!-- Información del Cliente -->
                <div class="row mb-4">
                  <div class="col-md-6">
                    <h5 class="text-primary">Información del Cliente</h5>
                    <p><strong>Nombre:</strong> {{ $equipment->customer_name }}</p>
                    <p><strong>Teléfono:</strong> {{ $equipment->customer_phone }}</p>
                    @if($equipment->customer_email)
                    <p><strong>Email:</strong> {{ $equipment->customer_email }}</p>
                    @endif
                  </div>
                  <div class="col-md-6">
                    <h5 class="text-primary">Información del Equipo</h5>
                    <p><strong>Tipo:</strong> <span id="eqType">{{ isset($equipment->type) ? $equipment->type->name : (isset($equipment->equipment_type) ? ucfirst($equipment->equipment_type) : 'N/D') }}</span></p>
                    <p><strong>Marca:</strong> <span id="eqBrand">{{ isset($equipment->brand) && is_object($equipment->brand) ? $equipment->brand->name : ($equipment->brand ?? 'N/D') }}</span></p>
                    <p><strong>Modelo:</strong> <span id="eqModel">{{ isset($equipment->model) && is_object($equipment->model) ? $equipment->model->name : ($equipment->model ?? 'N/D') }}</span></p>
                    @if($equipment->serial_number)
                    <p><strong>Serie:</strong> {{ $equipment->serial_number }}</p>
                    @endif
                  </div>
                </div>

                <!-- Estado Actual -->
                <div class="row mb-4">
                  <div class="col-12">
                    <h5 class="text-primary">Estado Actual</h5>
                    <div class="text-center">
                      @php
                        $statusConfig = [
                            'received' => ['color' => 'primary', 'text' => 'Recibido', 'icon' => 'ni ni-single-copy-04'],
                            'in_review' => ['color' => 'warning', 'text' => 'En Revisión', 'icon' => 'ni ni-zoom-split-in'],
                            'in_repair' => ['color' => 'info', 'text' => 'En Reparación', 'icon' => 'ni ni-settings-gear-65'],
                            'waiting_parts' => ['color' => 'secondary', 'text' => 'Esperando Repuestos', 'icon' => 'ni ni-delivery-fast'],
                            'ready' => ['color' => 'success', 'text' => 'Listo', 'icon' => 'ni ni-check-bold'],
                            'delivered' => ['color' => 'dark', 'text' => 'Entregado', 'icon' => 'ni ni-send'],
                            'cancelled' => ['color' => 'danger', 'text' => 'Cancelado', 'icon' => 'ni ni-fat-remove']
                        ];
                        $currentStatus = $statusConfig[$equipment->status] ?? ['color' => 'secondary', 'text' => 'Desconocido', 'icon' => 'ni ni-single-copy-04'];
                      @endphp
                      <span class="badge badge-{{ $currentStatus['color'] }} status-badge" id="statusBadge">
                        <i class="{{ $currentStatus['icon'] }} mr-2" id="statusIcon"></i>
                        <span id="statusText">{{ $currentStatus['text'] }}</span>
                      </span>
                      <div class="mt-2">
                        <small class="text-muted">Última actualización: <span id="statusUpdatedAt">{{ \Carbon\Carbon::parse($equipment->updated_at)->format('d/m/Y H:i') }}</span></small>
                        <br>
                        <button type="button" class="btn btn-sm btn-outline-primary mt-2" onclick="updateStatus()">
                          <i class="ni ni-refresh mr-1"></i> Actualizar Estado
                        </button>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Información Adicional -->
                <div class="row mb-4">
                  <div class="col-md-6">
                    <h5 class="text-primary">Problema Reportado</h5>
                    <p class="text-muted">{{ $equipment->problem_description }}</p>
                  </div>
                  <div class="col-md-6">
                    <h5 class="text-primary">Información de Reparación</h5>
                    <p><strong>Fecha de Recepción:</strong> {{ \Carbon\Carbon::parse($equipment->received_at)->format('d/m/Y H:i') }}</p>
                    @if($equipment->estimated_delivery)
                    <p><strong>Entrega Estimada:</strong> {{ \Carbon\Carbon::parse($equipment->estimated_delivery)->format('d/m/Y') }}</p>
                    @endif
                    @if(isset($equipment->assignedTechnician))
                    <p><strong>Técnico Asignado:</strong> {{ $equipment->assignedTechnician->name }}</p>
                    @endif
                    @if($equipment->estimated_cost)
                    <p><strong>Costo Estimado:</strong> ${{ number_format($equipment->estimated_cost, 2) }}</p>
                    @endif
                </div>

                <!-- Historial de Estados -->
                @if($equipment->statusHistory && count($equipment->statusHistory) > 0)
                <div class="row">
                  <div class="col-12">
                    <h5 class="text-primary">Historial de Estados</h5>
                    <div class="timeline">
                      @foreach($equipment->statusHistory->sortByDesc('status_date') as $status)
                        @php
                          $statusInfo = $statusConfig[$status->status] ?? ['color' => 'secondary', 'text' => 'Desconocido'];
                        @endphp
                        <div class="timeline-item">
                          <div class="d-flex justify-content-between align-items-start">
                            <div>
                              <h6 class="mb-1">
                                <span class="badge badge-{{ $statusInfo['color'] }} mr-2">
                                  {{ $statusInfo['text'] }}
                                </span>
                              </h6>
                              @if($status->description)
                              <p class="text-muted mb-1">{{ $status->description }}</p>
                              @endif
                              @if($status->notes)
                              <p class="text-muted small mb-1"><em>{{ $status->notes }}</em></p>
                              @endif
                              <small class="text-muted">
                                {{ \Carbon\Carbon::parse($status->status_date)->format('d/m/Y H:i') }}
                                @if($status->updatedBy)
                                - {{ $status->updatedBy->name }}
                                @endif
                              </small>
                            </div>
                          </div>
                        </div>
                      @endforeach
                    </div>
                  </div>
                </div>
                @endif

                <!-- Accesorios -->
                @if($equipment->accessories)
                <div class="row mt-4">
                  <div class="col-12">
                    <h5 class="text-primary">Accesorios Incluidos</h5>
                    <p class="text-muted">{{ $equipment->accessories }}</p>
                  </div>
                </div>
                @endif

                <!-- Notas -->
                @if($equipment->notes)
                <div class="row mt-4">
                  <div class="col-12">
                    <h5 class="text-primary">Notas Adicionales</h5>
                    <p class="text-muted">{{ $equipment->notes }}</p>
                  </div>
                </div>
                @endif
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-6">
                <a href="{{ route('customer.query') }}" class="text-light"><small>← Nueva Consulta</small></a>
              </div>
              <div class="col-6 text-right">
                <a href="{{ route('home') }}" class="text-light"><small>Volver al sitio principal</small></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="separator separator-bottom separator-skew zindex-100">
      <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
        <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
      </svg>
    </div>
  </div>
</div>
<script>
  (function() {
    const statusMap = {
      received: { color: 'primary', text: 'Recibido', icon: 'ni ni-single-copy-04' },
      in_review: { color: 'warning', text: 'En Revisión', icon: 'ni ni-zoom-split-in' },
      in_repair: { color: 'info', text: 'En Reparación', icon: 'ni ni-settings-gear-65' },
      waiting_parts: { color: 'secondary', text: 'Esperando Repuestos', icon: 'ni ni-delivery-fast' },
      ready: { color: 'success', text: 'Listo', icon: 'ni ni-check-bold' },
      delivered: { color: 'dark', text: 'Entregado', icon: 'ni ni-send' },
      cancelled: { color: 'danger', text: 'Cancelado', icon: 'ni ni-fat-remove' }
    };

    const ticket = "{{ $equipment->ticket_number }}";
    const badge = document.getElementById('statusBadge');
    const textEl = document.getElementById('statusText');
    const iconEl = document.getElementById('statusIcon');
    const updatedAtEl = document.getElementById('statusUpdatedAt');
    const typeEl = document.getElementById('eqType');
    const brandEl = document.getElementById('eqBrand');
    const modelEl = document.getElementById('eqModel');

    async function updateStatus() {
      try {
        const button = document.querySelector('button[onclick="updateStatus()"]');
        const originalText = button.innerHTML;
        button.innerHTML = '<i class="ni ni-spinner ni-spin mr-1"></i> Actualizando...';
        button.disabled = true;

        const res = await fetch(`/consulta/status/${encodeURIComponent(ticket)}/json`, { headers: { 'Accept': 'application/json' } });
        if (!res.ok) {
          throw new Error('Error al obtener datos');
        }
        
        const data = await res.json();
        if (!data.found) {
          throw new Error('No se encontró el ticket');
        }
        
        const s = statusMap[data.status] || { color: 'secondary', text: 'Desconocido', icon: 'ni ni-single-copy-04' };

        // Actualizar badge
        if (badge) badge.className = `badge badge-${s.color} status-badge`;
        if (textEl) textEl.textContent = s.text;
        if (iconEl) iconEl.className = `${s.icon} mr-2`;
        if (data.status_updated_at && updatedAtEl) {
          try { 
            updatedAtEl.textContent = new Date(data.status_updated_at).toLocaleString('es-MX'); 
          } catch (e) {}
        }

        // Info del equipo si viene
        if (data.equipment) {
          if (data.equipment.type && typeEl) typeEl.textContent = data.equipment.type;
          if (data.equipment.brand && brandEl) brandEl.textContent = data.equipment.brand;
          if (data.equipment.model && modelEl) modelEl.textContent = data.equipment.model;
        }

        // Restaurar botón
        button.innerHTML = originalText;
        button.disabled = false;

        // Mostrar mensaje de éxito
        showMessage('Estado actualizado correctamente', 'success');
      } catch (e) {
        // Restaurar botón
        const button = document.querySelector('button[onclick="updateStatus()"]');
        button.innerHTML = '<i class="ni ni-refresh mr-1"></i> Actualizar Estado';
        button.disabled = false;
        
        showMessage('Error al actualizar el estado. Intenta nuevamente.', 'danger');
      }
    }

    function showMessage(message, type) {
      // Crear o actualizar mensaje de notificación
      let alertDiv = document.getElementById('updateAlert');
      if (!alertDiv) {
        alertDiv = document.createElement('div');
        alertDiv.id = 'updateAlert';
        alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
        alertDiv.style.position = 'fixed';
        alertDiv.style.top = '20px';
        alertDiv.style.right = '20px';
        alertDiv.style.zIndex = '9999';
        alertDiv.style.minWidth = '300px';
        document.body.appendChild(alertDiv);
      }
      
      alertDiv.innerHTML = `
        ${message}
        <button type="button" class="close" data-dismiss="alert">
          <span>&times;</span>
        </button>
      `;
      
      // Auto-ocultar después de 3 segundos
      setTimeout(() => {
        if (alertDiv) {
          alertDiv.remove();
        }
      }, 3000);
    }

    // Hacer la función global para que sea accesible desde onclick
    window.updateStatus = updateStatus;
  })();
</script>

</body>
</html>

