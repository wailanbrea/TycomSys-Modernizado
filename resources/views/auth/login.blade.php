<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>TicomSys - Acceso de Empleados</title>
<meta name="description" content="Acceso exclusivo para empleados de TicomSys">
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&amp;display=swap" rel="stylesheet"/>
<script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#175acf",
                        "background-light": "#f6f7f8",
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
</head>
<body class="bg-background-light font-display">
<div class="flex items-center justify-center min-h-screen">
<div class="w-full max-w-md p-8 space-y-8 bg-white rounded-xl shadow-lg">
<div class="text-center">
<div class="flex items-center justify-center gap-2 text-primary mb-4">
<img src="{{ asset('images/logoticomsys.png') }}" alt="TicomSys Logo" class="h-16 w-auto">
</div>
</div>
<form action="{{ route('login') }}" class="mt-8 space-y-6" method="POST">
@csrf
<div class="rounded-lg shadow-sm -space-y-px">
<div>
<label class="sr-only" for="email-address">Correo electrónico</label>
<input autocomplete="email" class="appearance-none rounded-t-lg relative block w-full px-3 py-4 border border-gray-300 placeholder-gray-500 text-gray-900 bg-background-light focus:outline-none focus:ring-primary focus:border-primary focus:z-10 sm:text-sm" id="email-address" name="email" placeholder="Correo electrónico" required="" type="email" value="{{ old('email') }}"/>
</div>
<div>
<label class="sr-only" for="password">Contraseña</label>
<input autocomplete="current-password" class="appearance-none rounded-b-lg relative block w-full px-3 py-4 border border-gray-300 placeholder-gray-500 text-gray-900 bg-background-light focus:outline-none focus:ring-primary focus:border-primary focus:z-10 sm:text-sm" id="password" name="password" placeholder="Contraseña" required="" type="password"/>
</div>
</div>

@if ($errors->any())
<div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
<strong>Error!</strong>
<ul class="mt-2 list-disc list-inside">
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif

<div class="flex items-center">
<input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
<label for="remember" class="ml-2 block text-sm text-gray-900">
Recordarme
</label>
</div>

<div>
<button class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary" type="submit">
Iniciar Sesión
</button>
</div>
</form>

<div class="text-center mt-6">
<a href="{{ route('home') }}" class="text-sm text-gray-600 hover:text-primary">
← Volver al sitio principal
</a>
</div>
</div>
</div>
</body>
</html>
