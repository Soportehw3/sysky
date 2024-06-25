<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Equipo;
use App\Models\Accesorio;
use App\Models\Empleado;

class HomeController extends Controller
{
    public function index()
    {
        $empleados_count = Empleado::count();
        $equipos_count = Equipo::count();
        $accesorios_count = Accesorio::count();

        return view('home', compact('empleados_count', 'equipos_count', 'accesorios_count'));
    }
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

}
