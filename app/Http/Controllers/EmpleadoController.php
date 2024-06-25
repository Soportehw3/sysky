<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;

class EmpleadoController extends Controller
{



    // Mostrar una lista de empleados
public function index(Request $request)
{
    $search = $request->input('search');
    $sortField = $request->input('sort', 'created_at');
    $sortOrder = $request->input('order', 'desc');

    $empleados = Empleado::when($search, function ($query, $search) {
        return $query->where('numero_nomina', 'like', "%{$search}%")
            ->orWhere('nombre', 'like', "%{$search}%");
    })->orderBy($sortField, $sortOrder)->paginate(10);

    return view('empleados.index', compact('empleados', 'search', 'sortField', 'sortOrder'));
}



    // Mostrar el formulario para crear un nuevo empleado
    public function create()
    {
        return view('empleados.create');
    }

    // Almacenar un nuevo empleado en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'numero_nomina' => 'required|string|max:50|unique:empleados',
            'nombre' => 'required|string|max:100',
            'apellidoP' => 'required|string|max:100',
            'apellidoM' => 'required|string|max:100',
            'puesto' => 'required|string|max:100',
            'area' => 'required|string|max:100',
        ]);

        Empleado::create($request->all());

        return redirect()->route('empleados.index')->with('success', 'Empleado creado exitosamente.');
    }

    // Mostrar un empleado específico
    public function show($id)
    {
        $empleado = Empleado::find($id);
        return view('empleados.show', compact('empleado'));
    }

    // Mostrar el formulario para editar un empleado existente
    public function edit($id)
    {
        $empleado = Empleado::find($id);
        return view('empleados.edit', compact('empleado'));
    }

    // Actualizar un empleado específico en la base de datos
    public function update(Request $request, $id)
    {
        $request->validate([
            'numero_nomina' => 'required|string|max:50|unique:empleados,numero_nomina,' . $id,
            'nombre' => 'required|string|max:100',
            'apellidoP' => 'required|string|max:100',
            'apellidoM' => 'required|string|max:100',
            'puesto' => 'required|string|max:100',
            'area' => 'required|string|max:100',
        ]);

        $empleado = Empleado::find($id);
        $empleado->update($request->all());

        return redirect()->route('empleados.index')->with('success', 'Empleado actualizado exitosamente.');
    }

    // Eliminar un empleado específico de la base de datos
    public function destroy($id)
    {
        $empleado = Empleado::find($id);
        $empleado->delete();

        return redirect()->route('empleados.index')->with('success', 'Empleado eliminado exitosamente.');
    }
    public function __construct()
    {
        $this->middleware('auth');
    }
}
