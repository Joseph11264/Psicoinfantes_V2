@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-200">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Editar Perfil de Usuario</h2>

        <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-600 uppercase">Nombre Completo</label>
                    <input type="text" name="name" value="{{ $user->name }}" required 
                        class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-600 uppercase">Correo Electrónico</label>
                    <input type="email" name="email" value="{{ $user->email }}" required 
                        class="w-full mt-1 border-gray-300 rounded-lg shadow-sm">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-600 uppercase">Rol / Rango</label>
                    <select name="role" required class="w-full mt-1 border-gray-300 rounded-lg shadow-sm">
                        <option value="recepcionista" {{ $user->role == 'recepcionista' ? 'selected' : '' }}>Recepcionista</option>
                        <option value="especialista" {{ $user->role == 'especialista' ? 'selected' : '' }}>Especialista</option>
                        <option value="gerente" {{ $user->role == 'gerente' ? 'selected' : '' }}>Gerente</option>
                    </select>
                </div>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 mt-6">
                <p class="text-sm font-bold text-gray-700 mb-2">Seguridad (Resetear Contraseña)</p>
                <p class="text-xs text-gray-500 mb-4 italic">Deje estos campos en blanco si no desea cambiar la contraseña actual del usuario.</p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-600 uppercase">Nueva Contraseña</label>
                        <input type="password" name="password" class="w-full mt-1 border-gray-300 rounded-lg shadow-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-600 uppercase">Confirmar Nueva Contraseña</label>
                        <input type="password" name="password_confirmation" class="w-full mt-1 border-gray-300 rounded-lg shadow-sm">
                    </div>
                </div>
            </div>

            <div class="flex gap-4 pt-4">
                <a href="{{ route('users.index') }}" class="flex-1 text-center py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-lg transition-colors">
                    Cancelar
                </a>
                <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 rounded-lg shadow-md transition-colors">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>
@endsection