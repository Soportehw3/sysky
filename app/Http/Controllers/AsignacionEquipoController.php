<?php

namespace App\Http\Controllers;

use App\Models\AsignacionEquipo;
use App\Models\Empleado;
use App\Models\Equipo;
use App\Models\User; // Cambio aquí
use App\Models\Empresa;
use Illuminate\Http\Request;

class AsignacionEquipoController extends Controller
{
    public function index()
    {
        $asignacionesequipos = AsignacionEquipo::with(['empleado', 'equipo', 'usuario', 'empresa'])->get();
        return view('asignacionesequipos.index', compact('asignacionesequipos'));
    }

    public function create()
    {
        $empleados = Empleado::all();
        $equipos = Equipo::all();
        $usuarios = User::all(); // Cambio aquí
        $empresas = Empresa::all();
        return view('asignacionesequipos.create', compact('empleados', 'equipos', 'usuarios', 'empresas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'empleado_id' => 'required|exists:empleados,id',
            'equipo_id' => 'required|exists:equipos,id',
            'fecha_asignacion' => 'required|date',
            'usuario_responsable' => 'required|exists:users,id', // Cambio aquí
            'ticket' => 'required|integer',
            'nota_descriptiva' => 'nullable|string|max:100',
            'empresa_id' => 'required|exists:empresas,id',
        ]);

        AsignacionEquipo::create($request->all());

        return redirect()->route('asignacionesequipos.index')
            ->with('success', 'Asignación de equipo creada con éxito.');
    }

    public function show(AsignacionEquipo $asignacion)
    {
        return view('asignacionesequipos.show', compact('asignacion'));
    }

    public function edit(AsignacionEquipo $asignacion)
    {
        $empleados = Empleado::all();
        $equipos = Equipo::all();
        $usuarios = User::all(); // Cambio aquí
        $empresas = Empresa::all();
        return view('asignacionesequipos.edit', compact('asignacion', 'empleados', 'equipos', 'usuarios', 'empresas'));
    }

    public function update(Request $request, AsignacionEquipo $asignacion)
    {
        $request->validate([
            'empleado_id' => 'required|exists:empleados,id',
            'equipo_id' => 'required|exists:equipos,id',
            'fecha_asignacion' => 'required|date',
            'usuario_responsable' => 'required|exists:users,id', // Cambio aquí
            'ticket' => 'required|integer',
            'nota_descriptiva' => 'nullable|string|max:100',
            'empresa_id' => 'required|exists:empresas,id',
        ]);

        $asignacion->update($request->all());

        return redirect()->route('asignacionesequipos.index')
            ->with('success', 'Asignación de equipo actualizada con éxito.');
    }

    public function destroy(AsignacionEquipo $asignacion)
    {
        $asignacion->delete();
        return redirect()->route('asignacionesequipos.index')
            ->with('success', 'Asignación de equipo eliminada con éxito.');
    }
    public function __construct()
    {
        $this->middleware('auth');
    }
}
