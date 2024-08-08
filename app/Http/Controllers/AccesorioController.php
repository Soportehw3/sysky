<?php

namespace App\Http\Controllers;

use App\Models\Accesorio;
use App\Models\Acciones;
use App\Notifications\LowStockNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
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
                ->orWhere('marca', 'like', "%{$search}%")
                ->orWhere('modelo', 'like', "%{$search}%");
        })->orderBy($sortField, $sortOrder)->paginate(10);

        return view('accesorios.index', compact('accesorios', 'search', 'sortField', 'sortOrder'));
    }

    public function create()
    {
        return view('accesorios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|max:150',
            'marca' => 'required|max:50',
            'modelo' => 'required|max:50',
            'cantidad' => 'required|integer',
            'orden_compra_acc' => 'required|integer',
            'requisicion' => 'required|integer',
            'cantidad_minima' => 'required|integer',
        ]);

        $accesorio = Accesorio::create($request->all());

        // Registrar la acción
        $accion = new Acciones();
        $accion->modulo = "Accesorios";
        $accion->descripcion = "Se creó el accesorio: " . $accesorio->descripcion;
        $accion->usuario_responsable_id = Auth::user()->id;
        $accion->created_at = Carbon::now('America/Mexico_City')->toDateTimeString();
        $accion->save();

        return redirect()->route('accesorios.index')
            ->with('success', 'Accesorio creado exitosamente.');
    }

    public function show(Accesorio $accesorio)
    {
        return view('accesorios.show', compact('accesorio'));
    }

    public function edit(Accesorio $accesorio)
    {
        return view('accesorios.edit', compact('accesorio'));
    }

    public function update(Request $request, Accesorio $accesorio)
    {
        $request->validate([
            'descripcion' => 'required|max:150',
            'marca' => 'required|max:50',
            'modelo' => 'required|max:50',
            'cantidad' => 'required|integer',
            'orden_compra_acc' => 'required|integer',
            'requisicion' => 'required|integer',
            'cantidad_minima' => 'required|integer',
        ]);

        $accesorio->update($request->all());



        // Registrar la acción
        $accion = new Acciones();
        $accion->modulo = "Accesorios";
        $accion->descripcion = "Se editó el accesorio: " . $accesorio->descripcio;
        $accion->usuario_responsable_id = Auth::user()->id;
        $accion->created_at = Carbon::now('America/Mexico_City')->toDateTimeString();
        $accion->save();

        return redirect()->route('accesorios.index')
            ->with('success', 'Accesorio actualizado exitosamente.');
    }

    public function destroy(Accesorio $accesorio)
    {
        $accesorio->delete();

        // Registrar la acción
        $accion = new Acciones();
        $accion->modulo = "Accesorios";
        $accion->descripcion = "Se eliminó el accesorio: " . $accesorio->marca;
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
