<?php
namespace App\Http\Controllers;

use App\Models\Accesorio;
use App\Models\Acciones;
use App\Models\MarcaAccesorio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AccesorioController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sortField = $request->input('sort', 'created_at');
        $sortOrder = $request->input('order', 'desc');

        $accesorios = Accesorio::when($search, function ($query, $search) {
            return $query->where('descripcion', 'like', "%{$search}%")
                ->orWhereHas('marcaAccesorio', function ($q) use ($search) {
                    $q->where('nombre', 'like', "%{$search}%");
                })
                ->orWhere('modelo', 'like', "%{$search}%");
        })->orderBy($sortField, $sortOrder)->paginate(10);
        

        return view('accesorios.index', compact('accesorios', 'search', 'sortField', 'sortOrder'));
    }

    public function create()
    {
        $marcasAccesorios = MarcaAccesorio::all();
        return view('accesorios.create', compact('marcasAccesorios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|max:100',
            'marca_id' => 'required|exists:marcas_accesorios,id', // Valida que marca_id existe
            'modelo' => 'required|max:50',
            'cantidad' => 'required|integer|min:1',
            'orden_compra_acc' => 'nullable|string',
            'requisicion' => 'nullable|string',
            'cantidad_minima' => 'required|integer|min:1',
        ]);

        $accesorio = new Accesorio($request->all()); // Aquí debe asignar marca_id correctamente
        $accesorio->save();
        

        // Registrar la acción
        $accion = new Acciones();
        $accion->modulo = "Accesorios";
        $accion->descripcion = "Se creó el accesorio: " . $accesorio->descripcion;
        $accion->usuario_responsable_id = Auth::user()->id;
        $accion->created_at = Carbon::now('America/Mexico_City')->toDateTimeString();
        $accion->save();

        return redirect()->route('accesorios.index')->with('success', 'Accesorio creado correctamente.');
    }

    public function show(Accesorio $accesorio)
    {
        return view('accesorios.show', compact('accesorio'));
    }

    public function edit(Accesorio $accesorio)
    {
        $marcasAccesorios = MarcaAccesorio::all();
        return view('accesorios.edit', compact('accesorio', 'marcasAccesorios'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'marca_id' => 'required|exists:marcas_accesorios,id', // Verifica que marca_id esté presente y sea válido
            'modelo' => 'required|string|max:255',
            'cantidad' => 'required|integer',
            'orden_compra_acc' => 'nullable|string',
            'requisicion' => 'nullable|string',
            'cantidad_minima' => 'nullable|integer',
        ]);

        $accesorio = Accesorio::findOrFail($id);
        $accesorio->update($request->all()); // Aquí debe asignar marca_id correctamente

        // Registrar la acción
        $accion = new Acciones();
        $accion->modulo = "Accesorios";
        $accion->descripcion = "Se editó el accesorio: " . $accesorio->descripcion;
        $accion->usuario_responsable_id = Auth::user()->id;
        $accion->created_at = Carbon::now('America/Mexico_City')->toDateTimeString();
        $accion->save();

        return redirect()->route('accesorios.index')->with('success', 'Accesorio actualizado correctamente.');

    }

    public function destroy(Accesorio $accesorio)
    {
        $descripcion = $accesorio->descripcion;
        $accesorio->delete();

        // Registrar la acción
        $accion = new Acciones();
        $accion->modulo = "Accesorios";
        $accion->descripcion = "Se eliminó el accesorio: " . $descripcion;
        $accion->usuario_responsable_id = Auth::user()->id;
        $accion->created_at = Carbon::now('America/Mexico_City')->toDateTimeString();
        $accion->save();

        return redirect()->route('accesorios.index')
            ->with('success', 'Accesorio eliminado exitosamente.');
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
}
