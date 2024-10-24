<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Acciones;

class AccionesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        // Obtener el término de búsqueda
        $search = $request->input('search');

        // Construir la consulta con relación al usuario y ordenar por fecha de creación
        $acciones = Acciones::with('usuario')
            ->when($search, function ($query) use ($search) {
                $query->where('modulo', 'like', "%{$search}%")
                      ->orWhere('descripcion', 'like', "%{$search}%")
                      ->orWhereHas('usuario', function ($query) use ($search) {
                          $query->where('name', 'like', "%{$search}%");
                      });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Pasar el término de búsqueda actual para mantenerlo en la vista
        return view('acciones.index', compact('acciones', 'search'));
    }
}
