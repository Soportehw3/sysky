<?php

namespace App\Http\Controllers;

use App\Models\AsignacionesAccesorios;
use App\Models\Empleado;
use App\Models\Accesorio;
use App\Models\User;
use Illuminate\Http\Request;

class AsignacionAccesoriosController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sortField = $request->input('sort', 'created_at');
        $sortOrder = $request->input('order', 'desc');

        $asignacionesaccesorios = AsignacionesAccesorios::with(['empleado', 'accesorio', 'usuario'])
            ->when($search, function ($query, $search) {
                return $query->whereHas('empleado', function ($q) use ($search) {
                    $q->where('nombre', 'like', "%{$search}%");
                })->orWhereHas('accesorio', function ($q) use ($search) {
                    $q->where('descripcion', 'like', "%{$search}%");
                })->orWhere('fecha_asignacion', 'like', "%{$search}%")
                ->orWhere('ticket', 'like', "%{$search}%");
            })
            ->orderBy($sortField, $sortOrder)
            ->paginate(10);

        return view('asignacionaccesorios.index', compact('asignacionesaccesorios', 'search', 'sortField', 'sortOrder'));
    }
    public function create()
    {
        $empleados = Empleado::all();
        $accesorios = Accesorio::all();
        $usuarios = User::all();
        return view('asignacionaccesorios.create', compact('empleados', 'accesorios', 'usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'empleado_id' => 'required|exists:empleados,id',
            'accesorio_id' => 'required|exists:accesorios,id',
            'cantidad_asignada' => 'required|integer',
            'fecha_asignacion' => 'required|date',
            'usuario_responsable' => 'required|exists:users,id',
            'ticket' => 'required|integer',
            'nota_descriptiva' => 'nullable|string|max:100',
        ]);

        AsignacionesAccesorios::create($request->all());

        return redirect()->route('asignacionaccesorios.index')
            ->with('success', 'Asignación de accesorio creada con éxito.');
    }

    public function show(AsignacionesAccesorios $asignacion)
    {
        return view('asignacionaccesorios.show', compact('asignacion'));
    }

    public function edit(AsignacionesAccesorios $asignacion)
    {
        $empleados = Empleado::all();
        $accesorios = Accesorio::all();
        $usuarios = User::all();
        return view('asignacionaccesorios.edit', compact('asignacion', 'empleados', 'accesorios', 'usuarios'));
    }

    public function update(Request $request, AsignacionesAccesorios $asignacion)
    {
        $request->validate([
            'empleado_id' => 'required|exists:empleados,id',
            'accesorio_id' => 'required|exists:accesorios,id',
            'cantidad_asignada' => 'required|integer',
            'fecha_asignacion' => 'required|date',
            'usuario_responsable' => 'required|exists:users,id',
            'ticket' => 'required|integer',
            'nota_descriptiva' => 'nullable|string|max:100',
        ]);

        $asignacion->update($request->all());

        return redirect()->route('asignacionaccesorios.index')
            ->with('success', 'Asignación de accesorio actualizada con éxito.');
    }

    public function destroy(AsignacionesAccesorios $asignacion)
    {
        $asignacion->delete();
        return redirect()->route('asignacionaccesorios.index')
            ->with('success', 'Asignación de accesorio eliminada con éxito.');
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
}
