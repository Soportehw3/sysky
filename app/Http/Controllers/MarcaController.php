<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    public function index()
    {
        $marcas = Marca::paginate(10); 
        return view('marcas.index', compact('marcas'));
    }
    

    public function create()
    {
        return view('marcas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:marcas,nombre|max:100',
        ]);

        Marca::create($request->all());

        return redirect()->route('marcas.index')
                         ->with('success', 'Marca creada exitosamente.');
    }

    public function edit(Marca $marca)
    {
        return view('marcas.edit', compact('marca'));
    }

    public function update(Request $request, Marca $marca)
    {
        $request->validate([
            'nombre' => 'required|unique:marcas,nombre,' . $marca->id . '|max:100',
        ]);

        $marca->update($request->all());

        return redirect()->route('marcas.index')
                         ->with('success', 'Marca actualizada exitosamente.');
    }

    public function destroy(Marca $marca)
    {
        $marca->delete();

        return redirect()->route('marcas.index')
                         ->with('success', 'Marca eliminada exitosamente.');
    }
}
