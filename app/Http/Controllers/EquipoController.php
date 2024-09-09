<?php

namespace App\Http\Controllers;

use App\Models\Acciones;
use App\Models\Equipo;
use App\Models\Marca;
use App\Models\TipoEquipo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EquipoController extends Controller
{
    // App\Http\Controllers\EquipoController.php

    public function index(Request $request)
    {
        $sortField = $request->get('sort', 'created_at');
        $sortOrder = $request->get('order', 'desc');
        $search = $request->get('search'); // Obtener el término de búsqueda

        // Guardar la página actual en la sesión
        $currentPage = $request->get('page', 1);
        session(['equipo_page' => $currentPage]);

        $equipos = Equipo::with(['marca', 'tipoEquipo'])
            ->leftJoin('marcas', 'equipos.marca_id', '=', 'marcas.id')
            ->leftJoin('tipos_equipos', 'equipos.tipo_equipo_id', '=', 'tipos_equipos.id')
            ->select('equipos.*', 'marcas.nombre as marca_nombre', 'tipos_equipos.nombre as tipoEquipo_nombre')
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('equipos.numero_serie', 'like', "%{$search}%")
                        ->orWhere('equipos.modelo', 'like', "%{$search}%")
                        ->orWhere('marcas.nombre', 'like', "%{$search}%")
                        ->orWhere('tipos_equipos.nombre', 'like', "%{$search}%")
                        ->orWhere('equipos.etiqueta_skytex', 'like', "%{$search}%")
                        ->orWhere('equipos.estado', 'like', "%{$search}%");
                });
            })
            ->when($sortField === 'marca', function ($query) use ($sortOrder) {
                return $query->orderBy('marca_nombre', $sortOrder);
            })
            ->when($sortField === 'tipoEquipo', function ($query) use ($sortOrder) {
                return $query->orderBy('tipoEquipo_nombre', $sortOrder);
            })
            ->when(!in_array($sortField, ['marca', 'tipoEquipo']), function ($query) use ($sortField, $sortOrder) {
                return $query->orderBy($sortField, $sortOrder);
            })
            ->paginate(50);

        return view('equipos.index', compact('equipos', 'sortField', 'sortOrder', 'search'));
    }

    public function create()
    {
        $marcas = Marca::all();
        $tipoequipos = TipoEquipo::all();
        return view('equipos.create', compact('marcas', 'tipoequipos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero_serie' => 'required|unique:equipos',
            'marca_id' => 'required|exists:marcas,id',
            'modelo' => 'required',
            'etiqueta_skytex' => 'required|unique:equipos,etiqueta_skytex',
            'tipo_equipo_id' => 'required|exists:tipos_equipos,id',  // Cambio aquí
            'orden_compra' => 'nullable',
            'requisicion' => 'nullable',
            'estado' => 'required',
        ], [
            'numero_serie.unique' => 'El Numero de serie ya está registrado.',
            'etiqueta_skytex.unique' => 'La etiqueta Skytex ya está registrada.',
        ]);

        $equipo = Equipo::create($request->all());

        // Registrar la acción
        $accion = new Acciones();
        $accion->modulo = "Equipo";
        $accion->descripcion = "Se creó el equipo: " . $equipo->etiqueta_skytex;
        $accion->usuario_responsable_id = Auth::user()->id;
        $accion->created_at = Carbon::now('America/Mexico_City')->toDateTimeString();
        $accion->save();

        return redirect()->route('equipos.index')
            ->with('success', 'Equipo creado correctamente.');
    }


    public function show($id)
    {
        $equipo = Equipo::with(['marca', 'tipoEquipo', 'asignacionActual.empleado'])->findOrFail($id);

        return view('equipos.show', compact('equipo'));
    }

    public function edit($id)
    {
        $marcas = Marca::all();
        $tipoequipos = TipoEquipo::all();
        $equipo = Equipo::findOrFail($id);
        return view('equipos.edit', compact('equipo', 'marcas', 'tipoequipos'));
    }

    public function update(Request $request, Equipo $equipo)
    {
        // Validación y actualización del equipo
        $request->validate([
            'numero_serie' => 'required|unique:equipos,numero_serie,' . $equipo->id,
            'marca_id' => 'required|exists:marcas,id',
            'modelo' => 'required',
            'etiqueta_skytex' => 'required|unique:equipos,etiqueta_skytex,' . $equipo->id,
            'tipo_equipo_id' => 'required|exists:tipos_equipos,id',
            'orden_compra' => 'nullable',
            'requisicion' => 'nullable',
            'estado' => 'required',
        ], [
            'numero_serie.unique' => 'El Numero de serie ya está registrado.',
            'etiqueta_skytex.unique' => 'La etiqueta Skytex ya está registrada.',
        ]);

        $equipo->update($request->all());

        // Registrar la acción
        $accion = new Acciones();
        $accion->modulo = "Equipo";
        $accion->descripcion = "Se Edito el equipo: " . $equipo->etiqueta_skytex;
        $accion->usuario_responsable_id = Auth::user()->id;
        $accion->created_at = Carbon::now('America/Mexico_City')->toDateTimeString();
        $accion->save();

        // Obtener la página actual desde la sesión
        $page = session('equipo_page', 1);

        // Redirigir a la página actual
        return redirect()->route('equipos.index', ['page' => $page])
            ->with('success', 'Equipo actualizado correctamente.');
    }

    public function destroy(Equipo $equipo)
    {
        $equipo->delete();

        return redirect()->route('equipos.index')
            ->with('success', 'Equipo eliminado correctamente.');
    }
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function baja(Request $request)
    {
        $search = $request->input('search');
        $sortField = $request->input('sort', 'created_at');
        $sortOrder = $request->input('order', 'desc');

        $equipos = Equipo::where('estado', 'Baja')
            ->when($search, function ($query, $search) {
                return $query->where('numero_serie', 'like', "%{$search}%")
                    ->orWhere('marca', 'like', "%{$search}%")
                    ->orWhere('modelo', 'like', "%{$search}%")
                    ->orWhere('etiqueta_skytex', 'like', "%{$search}%")
                    ->orWhere('tipo', 'like', "%{$search}%")
                    ->orWhere('orden_compra', 'like', "%{$search}%")
                    ->orWhere('requisicion', 'like', "%{$search}%");
            })
            ->orderBy($sortField, $sortOrder)
            ->paginate(10);

        return view('equipos.baja', compact('equipos', 'search', 'sortField', 'sortOrder'));
    }
}
