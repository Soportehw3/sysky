<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    // Mostrar una lista de empleados
   // En EquipoController.php
public function index(Request $request)
{
    $search = $request->input('search');
    $sortField = $request->input('sort', 'created_at');
    $sortOrder = $request->input('order', 'desc');

    $equipos = Equipo::when($search, function ($query, $search) {
        return $query->where('numero_serie', 'like', "%{$search}%")
            ->orWhere('marca', 'like', "%{$search}%")
            ->orWhere('modelo', 'like', "%{$search}%")
            ->orWhere('etiqueta_skytex', 'like', "%{$search}%")
            ->orWhere('tipo', 'like', "%{$search}%")
            ->orWhere('orden_compra', 'like', "%{$search}%")
            ->orWhere('requisicion', 'like', "%{$search}%")
            ->orWhere('estado', 'like', "%{$search}%");
    })->orderBy($sortField, $sortOrder)->paginate(10);

    return view('equipos.index', compact('equipos', 'search', 'sortField', 'sortOrder'));
}


    public function create()
    {
        return view('equipos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero_serie' => 'required|unique:equipos',
            'marca' => 'required',
            'modelo' => 'required',
            'etiqueta_skytex' => 'required|unique:equipos,etiqueta_skytex',
            'tipo' => 'required',
            'orden_compra' => 'required',
            'requisicion' => 'required',
            'estado' => 'required',
        ], [
            'numero_serie.unique' => 'El Numero de serie ya esta registrado.',
            'etiqueta_skytex.unique' => 'La etiqueta Skytex ya está registrada.',
        ]);

        $exists = Equipo::where('numero_serie', $request->numero_serie)
            ->orWhere('etiqueta_skytex', $request->etiqueta_skytex)
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->withErrors(['unique' => 'El Numero de serie o la etiqueta Skytex ya está registrada.'])
                ->withInput();
        }

        Equipo::create($request->all());

        return redirect()->route('equipos.index')
            ->with('success', 'Equipo creado correctamente.');
    }

    public function show(Equipo $equipo)
    {
        return view('equipos.show', compact('equipo'));
    }

    public function edit(Equipo $equipo)
    {
        return view('equipos.edit', compact('equipo'));
    }

    public function update(Request $request, Equipo $equipo)
    {
        $request->validate([
            'numero_serie' => 'required|unique:equipos,numero_serie,' . $equipo->id,
            'marca' => 'required',
            'modelo' => 'required',
            'etiqueta_skytex' => 'required|unique:equipos,etiqueta_skytex,' . $equipo->id,
            'tipo' => 'required',
            'orden_compra' => 'required',
            'requisicion' => 'required',
            'estado' => 'required',
        ], [
            'numero_serie.unique' => 'El Numero de serie ya esta registrado.',
            'etiqueta_skytex.unique' => 'La etiqueta Skytex ya está registrada.',
        ]);

        $exists = Equipo::where('numero_serie', $request->numero_serie)
            ->orWhere('etiqueta_skytex', $request->etiqueta_skytex)
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->withErrors(['unique' => 'El Numero de serie o la etiqueta Skytex ya está registrada.'])
                ->withInput();
        }

        $equipo->update($request->all());

        return redirect()->route('equipos.index')
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
}
