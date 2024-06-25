<?php

namespace App\Http\Controllers;

use App\Models\Accesorio;
use Illuminate\Http\Request;

class AccesorioController extends Controller
{
    // En AccesorioController.php
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
            'orden_compra_acc'=> 'required|integer',
            'requisicion' => 'required|integer',
        ]);

        Accesorio::create($request->all());

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
            'orden_compra_acc'=> 'required|integer',
            'requisicion' => 'required|integer',
        ]);

        $accesorio->update($request->all());

        return redirect()->route('accesorios.index')
            ->with('success', 'Accesorio actualizado exitosamente.');
    }

    public function destroy(Accesorio $accesorio)
    {
        $accesorio->delete();

        return redirect()->route('accesorios.index')
            ->with('success', 'Accesorio eliminado exitosamente.');
    }
    public function __construct()
    {
        $this->middleware('auth');
    }
}
