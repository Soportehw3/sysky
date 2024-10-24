<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function showProfile()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();
        return view('perfil', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            // Añadir validaciones para otros campos si es necesario
        ]);

        $user = Auth::user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        // Guardar otros campos si es necesario
        try {
            $user->save();
            return redirect()->route('perfil')->with('success', 'Perfil actualizado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('perfil')->with('error', 'Hubo un problema al actualizar el perfil: ' . $e->getMessage());
        }
        return redirect()->route('perfil')->with('success', 'Perfil actualizado correctamente.');
    }
}
