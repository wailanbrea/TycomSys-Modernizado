<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>TicomSys - Consulta de Estado de Equipos</title>
<meta name="description" content="Consulta el estado de tu equipo en reparación">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
<link href="https://demos.creative-tim.com/argon-dashboard/assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
<link href="https://demos.creative-tim.com/argon-dashboard/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
<link href="https://demos.creative-tim.com/argon-dashboard/assets/css/argon-dashboard.min.css?v=1.1.0" rel="stylesheet">
<style>
  .bg-gradient-primary {
    background: linear-gradient(87deg, #5e72e4 0, #825ee4 100%) !important;
  }
  .btn-primary {
    background-color: #5e72e4;
    border-color: #5e72e4;
  }
  .btn-primary:hover {
    background-color: #4c63d2;
    border-color: #4c63d2;
  }
  .form-control:focus {
    border-color: #5e72e4;
    box-shadow: 0 0 0 0.2rem rgba(94, 114, 228, 0.25);
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
          <div class="col-xl-5 col-lg-6 col-md-8 px-5">
            <div class="card bg-secondary shadow border-0">
              <div class="card-header bg-white pb-5">
                <div class="text-muted text-center mb-3">
                  <img src="{{ asset('images/logoticomsys.png') }}" alt="TicomSys Logo" class="img-fluid" style="max-height: 80px;">
                </div>
                <div class="text-center">
                  <h1 class="display-4 text-muted">TicomSys</h1>
                  <p class="text-muted">Consulta el estado de tu equipo</p>
                </div>
              </div>
              <div class="card-body px-lg-5 py-lg-5">
                <form id="queryForm" role="form">
                  @csrf
                  <div class="form-group mb-3">
                    <div class="input-group input-group-merge input-group-alternative">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-single-copy-04"></i></span>
                      </div>
                      <input class="form-control" placeholder="Número de ticket (ej: REP-2025-0001)" type="text" name="ticket_number" id="ticket_number" required>
                    </div>
                  </div>
                  
                  <div id="errorAlert" class="alert alert-danger" style="display: none;" role="alert">
                    <strong>Error!</strong> <span id="errorMessage"></span>
                  </div>
                  
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary my-4">
                      <i class="ni ni-zoom-split-in mr-2"></i>
                      Consultar Estado
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-12 text-center">
                <a href="{{ route('home') }}" class="text-light"><small>← Volver al sitio principal</small></a>
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
document.getElementById('queryForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const ticketNumber = document.getElementById('ticket_number').value;
    const errorAlert = document.getElementById('errorAlert');
    const errorMessage = document.getElementById('errorMessage');
    
    // Ocultar error anterior
    errorAlert.style.display = 'none';
    
    try {
        const response = await fetch('/consulta/status', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                ticket_number: ticketNumber
            })
        });
        
        if (response.ok) {
            // Redirigir a la página de estado
            window.location.href = `/consulta/status/${ticketNumber}`;
        } else {
            const data = await response.json();
            errorMessage.textContent = data.message || 'Error al consultar el estado';
            errorAlert.style.display = 'block';
        }
    } catch (error) {
        errorMessage.textContent = 'Error de conexión. Intenta nuevamente.';
        errorAlert.style.display = 'block';
    }
});
</script>
</body>
</html>



