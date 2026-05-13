@extends('layouts.app')

@section('content')
<div class="flex flex-col md:flex-row gap-6">
    
    <div class="md:w-1/3">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Registrar Nuevo Personal</h3>
            <form action="{{ route('users.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-gray-600 uppercase">Nombre Completo</label>
                    <input type="text" name="name" required class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-600 uppercase">Correo Electrónico</label>
                    <input type="email" name="email" required class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-600 uppercase">Rol Asignado</label>
                    <select name="role" required class="w-full mt-1 border-gray-300 rounded-lg shadow-sm">
                        <option value="recepcionista">Recepcionista</option>
                        <option value="especialista">Especialista</option>
                        <option value="gerente">Gerente</option>
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-xs font-bold text-gray-600 uppercase">Contraseña</label>
                        <input type="password" name="password" required class="w-full mt-1 border-gray-300 rounded-lg shadow-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-600 uppercase">Confirmar</label>
                        <input type="password" name="password_confirmation" required class="w-full mt-1 border-gray-300 rounded-lg shadow-sm">
                    </div>
                </div>
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition-colors shadow-md">
                    Dar de Alta
                </button>
            </form>
        </div>
    </div>

    <div class="md:w-2/3">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Nombre / Email</th>
                        <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Rango / Rol</th>
                        <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 text-sm">
                    @foreach($users as $user)
                    <tr>
                        <td class="px-6 py-4">
                            <div class="font-bold text-gray-900">{{ $user->name }}</div>
                            <div class="text-gray-500 text-xs">{{ $user->email }}</div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <form action="{{ route('users.update', $user->id) }}" method="POST">
                                @csrf @method('PUT')
                                <select name="role" onchange="this.form.submit()" 
                                    class="text-xs rounded-full px-3 py-1 font-bold border-none 
                                    {{ $user->role == 'gerente' ? 'bg-purple-100 text-purple-700' : ($user->role == 'especialista' ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-700') }}">
                                    <option value="recepcionista" {{ $user->role == 'recepcionista' ? 'selected' : '' }}>Recepcionista</option>
                                    <option value="especialista" {{ $user->role == 'especialista' ? 'selected' : '' }}>Especialista</option>
                                    <option value="gerente" {{ $user->role == 'gerente' ? 'selected' : '' }}>Gerente</option>
                                </select>
                            </form>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center items-center gap-3">
                                <a href="{{ route('users.edit', $user->id) }}" 
                                   class="bg-amber-100 text-amber-700 hover:bg-amber-200 px-3 py-1 rounded-full text-xs font-bold uppercase border border-amber-200 transition-colors">
                                    Editar Perfil
                                </a>

                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('¿Está seguro de revocar el acceso a este empleado?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 font-bold text-xs uppercase pt-1">
                                        Baja
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection