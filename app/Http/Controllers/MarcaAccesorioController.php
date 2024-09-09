<?php

namespace App\Http\Controllers;

use App\Models\MarcaAccesorio;
use Illuminate\Http\Request;

class MarcaAccesorioController extends Controller
{
    public function index()
    {
        $marcasAccesorios = MarcaAccesorio::paginate(10);
        return view('marcasaccesorios.index', compact('marcasAccesorios'));
    }
    
    public function create()
    {
        return view('marcasaccesorios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:marcas_accesorios,nombre|max:100',
        ]);

        MarcaAccesorio::create($request->all());

        return redirect()->route('marcasaccesorios.index')
                         ->with('success', 'Marca de accesorio creada exitosamente.');
    }

    public function edit(MarcaAccesorio $marcaAccesorio)
    {
        return view('marcasaccesorios.edit', compact('marcaAccesorio'));
    }

    public function update(Request $request, MarcaAccesorio $marcaAccesorio)
    {
        $request->validate([
            'nombre' => 'required|unique:marcas_accesorios,nombre,' . $marcaAccesorio->id . '|max:100',
        ]);

        $marcaAccesorio->update($request->all());

        return redirect()->route('marcasaccesorios.index')
                         ->with('success', 'Marca de accesorio actualizada exitosamente.');
    }

    public function destroy(MarcaAccesorio $marcaAccesorio)
    {
        $marcaAccesorio->delete();

        return redirect()->route('marcasaccesorios.index')
                         ->with('success', 'Marca de accesorio eliminada exitosamente.');
    }
}
