<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    public function index()
    {
        $equipos = Equipo::all();
        return view('equipos.index', compact('equipos'));
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
            'etiqueta_skytex' => 'required',
            'tipo' => 'required',
            'estado' => 'required',
        ]);

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
            'numero_serie' => 'required|unique:equipos,numero_serie,'.$equipo->id,
            'marca' => 'required',
            'modelo' => 'required',
            'etiqueta_skytex' => 'required',
            'tipo' => 'required',
            'estado' => 'required',
        ]);

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
}
