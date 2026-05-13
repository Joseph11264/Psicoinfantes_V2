<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index()
    {
        // Traemos a todos los usuarios para la gestión
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function store(Request $request)
    {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'role' => ['required', 'in:gerente,especialista,recepcionista'],
            ]);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);

            return redirect()->route('users.index')->with('success', 'Personal registrado exitosamente.');
        }

    public function update(Request $request, User $user)
    {
        // 1. Validación flexible
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:gerente,especialista,recepcionista',
            'password' => 'nullable|min:8|confirmed', // Opcional
        ];

        $validated = $request->validate($rules);

        // 2. Actualizamos datos básicos
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];

        // 3. Solo actualizamos la contraseña si el Gerente escribió una nueva
        if ($request->filled('password')) {
            $user->password = \Illuminate\Support\Facades\Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', "Datos de {$user->name} actualizados correctamente.");
    }

    // Necesitamos este método para mostrar el formulario de edición
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
}

    public function destroy(User $user)
    {
        // Evitar que el admin se borre a sí mismo
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Operación denegada: No puedes eliminar tu propia cuenta.');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'Acceso revocado al usuario.');
    }
}