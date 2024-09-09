<?php

namespace App\Http\Controllers;

use App\Models\TipoEquipo;
use Illuminate\Http\Request;

class TipoEquipoController extends Controller
{
    public function index()
    {
        $tiposEquipos = TipoEquipo::paginate(10);
        return view('tiposequipos.index', compact('tiposEquipos'));
    }
    public function create()
    {
        return view('tiposequipos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:tipos_equipos,nombre|max:100',
        ]);

        TipoEquipo::create($request->all());

        return redirect()->route('tiposequipos.index')
            ->with('success', 'Tipo de equipo creado exitosamente.');
    }

    public function edit(TipoEquipo $tipoEquipo)
    {
        return view('tiposequipos.edit', compact('tipoEquipo'));
    }

    public function update(Request $request, TipoEquipo $tipoEquipo)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|unique:tipos_equipos,nombre,' . $tipoEquipo->id . '|max:100',
        ]);

        // Intentar actualizar y manejar posibles errores
        try {
            $tipoEquipo->update($validatedData);
            return redirect()->route('tiposequipos.index')
                ->with('success', 'Tipo de equipo actualizado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('tiposequipos.index')
                ->with('error', 'Hubo un problema al actualizar el tipo de equipo.');
        }
    }



    public function destroy(TipoEquipo $tipoEquipo)
    {
        $tipoEquipo->delete();

        return redirect()->route('tiposequipos.index')
            ->with('success', 'Tipo de equipo eliminado exitosamente.');
    }
}
