<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Psicoinfantes - Gestión</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
</head>
<body class="bg-gray-100 font-sans">
    <nav class="bg-blue-600 p-4 text-white shadow-lg">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="font-bold text-xl tracking-tight">Psicoinfantes v1.0</h1>
        <ul class="flex gap-6 font-medium">
            <li>
                <a href="{{ route('pacientes.index') }}" 
                   class="hover:text-blue-200 transition-colors {{ request()->is('pacientes*') ? 'border-b-2 border-white' : '' }}">
                    Pacientes
                </a>
            </li>
            <li>
                <a href="{{ route('especialistas.index') }}" 
                   class="hover:text-blue-200 transition-colors {{ request()->is('especialistas*') ? 'border-b-2 border-white' : '' }}">
                    Especialistas
                </a>
            </li>
            <li>
                <a href="{{ route('citas.index') }}" 
                   class="hover:text-blue-200 transition-colors {{ request()->is('citas*') ? 'border-b-2 border-white' : '' }}">
                    Agenda de Citas
                </a>
            </li>
            <li>
                <a href="{{ route('areas.index') }}" 
                   class="hover:text-blue-200 transition-colors {{ request()->is('areas*') ? 'border-b-2 border-white' : '' }}">
                    Infraestructura
                </a>
            </li>
        </ul>
    </div>
</nav>
    <main class="container mx-auto mt-8 p-4 bg-white rounded-lg shadow">
        @yield('content')
    </main>
</body>
</html>