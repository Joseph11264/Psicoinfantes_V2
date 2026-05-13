<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Psicoinfantes - Gestión Clínica</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans text-gray-800 h-screen flex overflow-hidden">

    <aside class="w-64 bg-blue-800 text-white flex flex-col shadow-xl hidden md:flex">
        <div class="h-16 flex items-center justify-center border-b border-blue-700">
            <h1 class="font-bold text-xl tracking-tight">Psicoinfantes v2.0</h1>
        </div>
        
        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
            <a href="{{ route('dashboard') }}" class="block px-4 py-2.5 rounded transition-colors {{ request()->routeIs('dashboard') ? 'bg-blue-900 border-l-4 border-yellow-400 font-bold' : 'hover:bg-blue-700' }}">
                📊 Dashboard Reportes
            </a>
            <a href="{{ route('pacientes.index') }}" class="block px-4 py-2.5 rounded transition-colors {{ request()->routeIs('pacientes.*') ? 'bg-blue-900 border-l-4 border-white font-bold' : 'hover:bg-blue-700' }}">
                👥 Pacientes
            </a>
            <a href="{{ route('especialistas.index') }}" class="block px-4 py-2.5 rounded transition-colors {{ request()->routeIs('especialistas.*') ? 'bg-blue-900 border-l-4 border-white font-bold' : 'hover:bg-blue-700' }}">
                👨‍⚕️ Especialistas
            </a>
            <a href="{{ route('citas.index') }}" class="block px-4 py-2.5 rounded transition-colors {{ request()->routeIs('citas.*') ? 'bg-blue-900 border-l-4 border-white font-bold' : 'hover:bg-blue-700' }}">
                📅 Agenda de Citas
            </a>
            <a href="{{ route('areas.index') }}" class="block px-4 py-2.5 rounded transition-colors {{ request()->routeIs('areas.*') ? 'bg-blue-900 border-l-4 border-white font-bold' : 'hover:bg-blue-700' }}">
                🏢 Infraestructura
            </a>

            @if(auth()->check() && auth()->user()->role === 'gerente')
            <div class="pt-4 mt-4 border-t border-blue-700">
                <p class="px-4 text-xs font-semibold text-blue-300 uppercase tracking-wider mb-2">Administración</p>
                <a href="{{ route('users.index') }}" class="block px-4 py-2.5 rounded transition-colors {{ request()->routeIs('users.*') ? 'bg-blue-900 border-l-4 border-purple-400 font-bold' : 'hover:bg-blue-700' }}">
                    ⚙️ Gestión de Personal
                </a>
            </div>
            @endif
        </nav>
    </aside>

    <div class="flex-1 flex flex-col h-screen">
        
        <header class="h-16 bg-white shadow-sm flex items-center justify-end px-6 border-b border-gray-200">
            
            <div class="flex items-center gap-4">
                @auth
                <div class="text-right">
                    <p class="text-sm font-bold text-gray-800">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500 capitalize">Rol: {{ Auth::user()->role }}</p>
                </div>
                
                <form method="POST" action="{{ route('logout') }}" class="ml-4 border-l pl-4 border-gray-200">
                    @csrf
                    <button type="submit" class="text-sm font-semibold text-red-600 hover:text-red-800 transition-colors">
                        Cerrar Sesión
                    </button>
                </form>
                @endauth
            </div>
        </header>

        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6">
            
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
            
        </main>
    </div>

</body>
</html>