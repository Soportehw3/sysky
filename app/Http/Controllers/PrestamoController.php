<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use App\Models\Equipo;
use App\Models\Empleado;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Acciones;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PrestamoController extends Controller
{
    public function index(Request $request)
    {
        // Obtén el término de búsqueda de la solicitud
        $search = $request->input('search');

        // Construye la consulta base con el orden de creación descendente
        $prestamos = Prestamo::with(['equipo.tipoEquipo', 'equipo.marca', 'empleado', 'usuario'])
            ->orderBy('created_at', 'desc');  // Ordenar por fecha de creación en orden descendente

        // Aplica el filtro de búsqueda si hay un término de búsqueda
        if ($search) {
            $prestamos = $prestamos->whereHas('empleado', function ($query) use ($search) {
                $query->where('nombre', 'like', "%{$search}%")
                    ->orWhere('apellidoP', 'like', "%{$search}%")
                    ->orWhere('apellidoM', 'like', "%{$search}%");
            })->orWhereHas('equipo', function ($query) use ($search) {
                $query->where('etiqueta_skytex', 'like', "%{$search}%");
            })->orWhereHas('usuario', function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            });
        }

        // Pagina los resultados
        $prestamos = $prestamos->paginate(10);

        // Retorna la vista con los resultados
        return view('prestamos.index', compact('prestamos', 'search'));
    }



    public function create()
    {
        $equipos = Equipo::all();
        $empleados = Empleado::all();
        $usuarios = User::all();

        return view('prestamos.create', compact('equipos', 'empleados', 'usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'equipo_id' => 'required|exists:equipos,id',
            'empleado_id' => 'required|exists:empleados,id',
            'fecha_prestamo' => 'required|date',
            'fecha_regreso' => 'required|date|after_or_equal:fecha_prestamo',
        ]);

        $prestamo = Prestamo::create([
            'equipo_id' => $request->equipo_id,
            'empleado_id' => $request->empleado_id,
            'fecha_prestamo' => $request->fecha_prestamo,
            'fecha_regreso' => $request->fecha_regreso,
            'usuario_responsable_id' => Auth::user()->id,
        ]);

        // Registrar la acción
        $accion = new Acciones();
        $accion->modulo = "Préstamos";
        $accion->descripcion = "Se creó el préstamo para el equipo con número de serie: " . $prestamo->equipo->numero_serie;
        $accion->usuario_responsable_id = Auth::user()->id;
        $accion->created_at = Carbon::now('America/Mexico_City')->toDateTimeString();
        $accion->save();

        return redirect()->route('prestamos.index')->with('success', 'Préstamo creado exitosamente.');
    }

    public function show($id)
    {
        $prestamo = Prestamo::with(['empleado', 'equipo.tipoEquipo', 'equipo.marca', 'usuario'])->findOrFail($id);
        return view('prestamos.show', compact('prestamo'));
    }

    public function edit($id)
    {
        $prestamo = Prestamo::with(['empleado', 'equipo', 'usuario'])->findOrFail($id);
        $empleados = Empleado::all();
        $equipos = Equipo::all();
        $usuarios = User::all();
        return view('prestamos.edit', compact('prestamo', 'empleados', 'equipos', 'usuarios'));
    }

    public function update(Request $request, Prestamo $prestamo)
    {
        $request->validate([
            'equipo_id' => 'required|exists:equipos,id',
            'empleado_id' => 'required|exists:empleados,id',
            'fecha_prestamo' => 'required|date',
            'fecha_regreso' => 'required|date|after_or_equal:fecha_prestamo',
            'devuelto' => 'boolean',
        ]);

        // Verificar si el estado "devuelto" ha cambiado
        $devueltoCambio = $prestamo->devuelto !== $request->devuelto;

        $prestamo->update([
            'equipo_id' => $request->equipo_id,
            'empleado_id' => $request->empleado_id,
            'fecha_prestamo' => $request->fecha_prestamo,
            'fecha_regreso' => $request->fecha_regreso,
            'usuario_responsable_id' => Auth::user()->id,
            'devuelto' => $request->devuelto,
        ]);

        // Registrar la acción si el estado "devuelto" cambió
        $accion = new Acciones();
        $accion->modulo = "Préstamos";
        $accion->descripcion = "Se actualizó el préstamo del equipo con número de serie: " . $prestamo->equipo->numero_serie;
        if ($devueltoCambio) {
            $accion->descripcion .= " y se cambió el estado a devuelto: " . ($request->devuelto ? 'Sí' : 'No');
        }
        $accion->usuario_responsable_id = Auth::user()->id;
        $accion->created_at = Carbon::now('America/Mexico_City')->toDateTimeString();
        $accion->save(); {
            // Validación y actualización del préstamo

            return redirect()->route('prestamos.index', ['page' => $request->input('page', 1)])
                ->with('success', 'Préstamo actualizado exitosamente.');
        }
    }


    public function destroy(Prestamo $prestamo)
    {
        $prestamo->delete();

        // Registrar la acción
        $accion = new Acciones();
        $accion->modulo = "Préstamos";
        $accion->descripcion = "Se eliminó el préstamo del equipo con número de serie: " . $prestamo->equipo->numero_serie;
        $accion->usuario_responsable_id = Auth::user()->id;
        $accion->created_at = Carbon::now('America/Mexico_City')->toDateTimeString();
        $accion->save();

        return redirect()->route('prestamos.index')->with('success', 'Préstamo eliminado exitosamente.');
    }
}
