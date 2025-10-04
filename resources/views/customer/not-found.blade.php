<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>TicomSys - Equipo No Encontrado</title>
<meta name="description" content="Equipo no encontrado en el sistema">
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
                </div>
              </div>
              <div class="card-body px-lg-5 py-lg-5">
                <div class="text-center mb-4">
                  <i class="ni ni-fat-remove text-danger" style="font-size: 4rem;"></i>
                </div>
                <h3 class="text-center text-danger mb-3">Equipo No Encontrado</h3>
                <p class="text-center text-muted mb-4">
                  No se encontró ningún equipo con el número de ticket: 
                  <strong>{{ $ticketNumber }}</strong>
                </p>
                <div class="alert alert-warning" role="alert">
                  <i class="ni ni-notification-70 mr-2"></i>
                  <strong>Verifica que:</strong>
                  <ul class="mb-0 mt-2">
                    <li>El número de ticket esté escrito correctamente</li>
                    <li>El equipo haya sido registrado en nuestro sistema</li>
                    <li>No haya espacios adicionales antes o después del número</li>
                  </ul>
                </div>
                <div class="text-center">
                  <a href="{{ route('customer.query') }}" class="btn btn-primary">
                    <i class="ni ni-zoom-split-in mr-2"></i>
                    Intentar Nuevamente
                  </a>
                </div>
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
</body>
</html>



