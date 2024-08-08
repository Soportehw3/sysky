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

    public function index()
    {
        $acciones = Acciones::with('usuario')
            ->orderBy('created_at', 'desc') // Ordenar de forma descendente
            ->paginate(10); // Paginación de 10 registros por página
        
        return view('acciones.index', compact('acciones'));
    }
}
