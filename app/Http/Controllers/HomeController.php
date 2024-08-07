<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Equipo;
use App\Models\Accesorio;
use App\Models\AsignacionEquipo;
use App\Models\Empleado;

class HomeController extends Controller
{
    public function home()
    {
        $empleados_count = Empleado::count();
        $equipos_count = Equipo::count();
        $accesorios_count = Accesorio::count();
        $equiposAsignados = Equipo::where('estado', 'Asignado')->count();
        $equiposNoAsignados = Equipo::where('estado', 'No asignado')->count();
        $equiposBaja = Equipo::where('estado', 'Baja')->count();

        // Temporalmente verifica los datos
        // dd($empleados_count, $equipos_count, $accesorios_count, $equiposAsignados, $equiposNoAsignados, $equiposBaja);
        $ultimasAsignaciones = AsignacionEquipo::with(['empleado', 'equipo'])
            ->orderBy('fecha_asignacion', 'desc')
            ->take(10)
            ->get();

        // Obtener accesorios con cantidad baja
        $accesoriosCantidadBaja = Accesorio::whereColumn('cantidad', '<=', 'cantidad_minima')->get();


        return view('home', compact(
            'empleados_count',
            'equipos_count',
            'accesorios_count',
            'equiposAsignados',
            'equiposNoAsignados',
            'equiposBaja',
            'ultimasAsignaciones',
            'accesoriosCantidadBaja'
        ));
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
