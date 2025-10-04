<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Roles - TicomSys</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <!-- Header -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-6">
                    <div class="flex items-center">
                        <img src="{{ asset('images/logoticomsys.png') }}" alt="TicomSys" class="h-8 w-auto">
                        <h1 class="ml-3 text-2xl font-bold text-gray-900">Gestionar Roles</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-800">← Volver al Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                                Cerrar Sesión
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="px-4 py-6 sm:px-0">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Roles -->
                    <div class="bg-white shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 sm:px-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Roles del Sistema</h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">Gestiona los roles y sus permisos.</p>
                        </div>
                        <ul class="divide-y divide-gray-200">
                            @foreach($roles as $role)
                            <li class="px-6 py-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $role->display_name }}</div>
                                        <div class="text-sm text-gray-500">{{ $role->description }}</div>
                                        <div class="mt-2">
                                            @foreach($role->permissions as $permission)
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800 mr-1">
                                                {{ $permission->display_name }}
                                            </span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <button class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">
                                        Editar
                                    </button>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Permisos -->
                    <div class="bg-white shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 sm:px-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Permisos Disponibles</h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">Lista de todos los permisos del sistema.</p>
                        </div>
                        <ul class="divide-y divide-gray-200">
                            @foreach($permissions as $permission)
                            <li class="px-6 py-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $permission->display_name }}</div>
                                        <div class="text-sm text-gray-500">{{ $permission->description }}</div>
                                        <div class="text-xs text-gray-400 mt-1">{{ $permission->name }}</div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>



