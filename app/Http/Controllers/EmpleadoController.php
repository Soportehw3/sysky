<?php

namespace App\Http\Controllers;

use App\Models\Acciones;
use App\Models\AsignacionEquipo;
use Illuminate\Http\Request;
use App\Models\Empleado;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class EmpleadoController extends Controller
{
    // Mostrar una lista de empleados
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sortField = $request->input('sort', 'created_at');
        $sortOrder = $request->input('order', 'desc');

        $empleados = Empleado::when($search, function ($q) use ($search) {
            $q->whereRaw("CONCAT(nombre, ' ', apellidoP, ' ', apellidoM) LIKE ?", ["%{$search}%"])
                ->orWhere('numero_nomina', 'like', "%{$search}%");
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
            'numero_nomina' => 'required|string|max:50|unique:empleados,numero_nomina',
            'nombre' => 'required|string|max:100',
            'apellidoP' => 'required|string|max:100',
            'apellidoM' => 'required|string|max:100',
            'puesto' => 'required|string|max:100',
            'area' => 'required|string|max:100',
            'status' => 'required|string|max:100',
        ]);

        Empleado::create($request->all());

        return redirect()->route('empleados.index')->with('success', 'Empleado creado exitosamente.');
    }

    public function show($id)
    {
        $empleado = Empleado::with(['asignacionesequipos.equipo.marca', 'asignacionesequipos.equipo.tipoEquipo', 'asignacionesaccesorios.accesorio.marcaAccesorio', 'prestamos.equipo', 'salidas.equipo'])->find($id);

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
            'status' => 'required|string|max:100',
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
    public function desasignarEquipo($idAsignacion)
    {
        // Buscar la asignación de equipo por su ID
        $asignacion = AsignacionEquipo::find($idAsignacion);
        
        $accion = new Acciones();
        $accion->modulo = "Empleados";
        $accion->descripcion = "Se registró la desasignacion de equipo: " . $asignacion->equipo->etiqueta_skytex . " de el empleado: " . $asignacion->empleado->nombre . " " . $asignacion->empleado-> apellidoP . " " .$asignacion->empleado-> apellidoM;
        $accion->usuario_responsable_id = Auth::user()->id;
        $accion->created_at = Carbon::now('America/Mexico_City')->toDateTimeString();
        $accion->save();
    
        if ($asignacion) {
            // Cambiar el estado del equipo a "no asignado"
            $equipo = $asignacion->equipo;
            $equipo->estado = 'No asignado';  // Actualizar el estado del equipo
            $equipo->save();
    
            // Actualizar el estado de la asignación en lugar de eliminarla
            $asignacion->estado = 'No asignado'; // O 'desasignado'
            $asignacion->save();
    
            return redirect()->route('empleados.show', $asignacion->empleado_id)
                ->with('success', 'Equipo desasignado y marcado como no asignado exitosamente.');
        }
    
        return redirect()->route('empleados.show', $asignacion->empleado_id)
            ->with('error', 'La asignación no fue encontrada.');
    }
    

}
