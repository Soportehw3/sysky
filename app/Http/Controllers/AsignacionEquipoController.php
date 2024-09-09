<?php

namespace App\Http\Controllers;

use App\Models\Acciones;
use App\Models\AsignacionEquipo;
use App\Models\Empleado;
use App\Models\Equipo;
use App\Models\User;
use App\Models\Empresa;
use App\Models\Prestamo;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class AsignacionEquipoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sortField = $request->input('sort', 'created_at');
        $sortOrder = $request->input('order', 'desc');

        $asignacionesequipos = AsignacionEquipo::with(['empleado', 'equipo', 'usuario', 'empresa'])
            ->when($search, function ($query, $search) {
                return $query->whereHas('empleado', function ($q) use ($search) {
                    $q->whereRaw("CONCAT(nombre, ' ', apellidoP, ' ', apellidoM) LIKE ?", ["%{$search}%"]);
                })->orWhereHas('equipo', function ($q) use ($search) {
                    $q->where('numero_serie', 'like', "%{$search}%");
                })->orWhere('fecha_asignacion', 'like', "%{$search}%")
                    ->orWhere('ticket', 'like', "%{$search}%");
            })
            ->orderBy($sortField, $sortOrder)
            ->paginate(10);


        return view('asignacionesequipos.index', compact('asignacionesequipos', 'search', 'sortField', 'sortOrder'));
    }


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $empleados = Empleado::all();
        $equipos = Equipo::all();
        $empresas = Empresa::all();

        return view('asignacionesequipos.create', compact('empleados', 'equipos', 'empresas'));
    }

    public function edit($id)
    {
        $asignacion = AsignacionEquipo::findOrFail($id);
        $empleados = Empleado::all();
        $equipos = Equipo::all();
        $empresas = Empresa::all();

        return view('asignacionesequipos.edit', compact('asignacion', 'empleados', 'equipos', 'empresas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'empleado_id' => 'required|exists:empleados,id',
            'equipo_id' => 'required|exists:equipos,id',
            'fecha_asignacion' => 'required|date',
            'ticket' => 'required|integer',
            'nota_descriptiva' => 'nullable|string',
            'empresa_id' => 'required|exists:empresas,id',
            'estado' => 'required|string|max:50',
            //'fecha_regreso' => $request->estado == 'prestamo' ? 'required|date|after_or_equal:fecha_prestamo' : 'nullable',


        ]);

        $asignacion = AsignacionEquipo::findOrFail($id);
        $request['usuario_responsable'] = Auth::id(); // Establecer el usuario autenticado
        $asignacion->update($request->all());

        // Actualizar o crear préstamo según sea necesario
        /* if ($request->estado == 'prestamo') {
            Prestamo::updateOrCreate(
                ['equipo_id' => $asignacion->equipo_id],
                [
                    'empleado_id' => $asignacion->empleado_id,
                    'fecha_prestamo' => now(),
                    'fecha_regreso' => $request->fecha_regreso,
                    'usuario_responsable_id' => Auth::user()->id,
                    'devuelto' => false,
                ]
            );
        }*/

        // Actualizar el estado del equipo
        $equipo = Equipo::findOrFail($request->equipo_id);
        $equipo->update(['estado' => $request->estado]);


        // Registrar la acción
        $accion = new Acciones();
        $accion->modulo = "Asignacion de Equipo";
        $accion->descripcion = "Se actualizó la asignación de equipo: " . $equipo->etiqueta_skytex . " para el empleado: " . $asignacion->empleado->nombre . " " . $asignacion->empleado->apellidoP . " " . $asignacion->empleado->apellidoM;
        $accion->usuario_responsable_id = Auth::id();
        $accion->created_at = Carbon::now('America/Mexico_City')->toDateTimeString();
        $accion->save();

        return redirect()->route('asignacionesequipos.index')
            ->with('success', 'Asignación de equipo actualizada correctamente');
    }


    public function store(Request $request)
    {
        $request->validate([
            'asignaciones' => 'required|json',
        ]);

        $asignaciones = json_decode($request->asignaciones, true);

        foreach ($asignaciones as $asignacionData) {
            // Verificar si el equipo ya está asignado o dado de baja
            $equipo = Equipo::findOrFail($asignacionData['equipo_id']);
            if ($equipo->estado == 'asignado' || $equipo->estado == 'baja') {
                return redirect()->back()->withErrors(['El equipo ' . $equipo->etiqueta_skytex . ' ya está asignado o dado de baja.']);
            }

            $asignacionData['usuario_responsable'] = Auth::id(); // Establecer el usuario autenticado
            AsignacionEquipo::create($asignacionData);

            // Actualizar el estado del equipo
            $equipo->update(['estado' => $asignacionData['estado']]);

            // Registrar la acción
            $accion = new Acciones();
            $accion->modulo = "Asignacion de Equipo";
            $accion->descripcion = "Se creó la asignación del Equipo: " . $equipo->etiqueta_skytex;
            $accion->usuario_responsable_id = Auth::id();
            $accion->created_at = Carbon::now('America/Mexico_City')->toDateTimeString();
            $accion->save();
        }

        return redirect()->route('asignacionesequipos.index')->with('success', 'Las asignaciones de equipos se han creado correctamente.');
    }



    public function show($id)
    {
        $asignacion = AsignacionEquipo::with(['empleado', 'equipo', 'usuario', 'empresa'])->findOrFail($id);
        return view('asignacionesequipos.show', compact('asignacion'));
    }


    public function generatePdf($id)
    {
        $asignacion = AsignacionEquipo::findOrFail($id);
        $asignaciones = AsignacionEquipo::where('ticket', $asignacion->ticket)->get();

        $pdf = FacadePdf::loadView('documentos.pdf', compact('asignacion', 'asignaciones'));

        return $pdf->stream('asignacion_' . $asignacion->empleado->nombre . '.pdf');
    }

    public function destroy($id)
    {
        $asignacion = AsignacionEquipo::findOrFail($id);
        $equipo_id = $asignacion->equipo_id;
        $asignacion->delete();

        // Actualizar el estado del equipo a 'No asignado' cuando se elimina la asignación
        $equipo = Equipo::findOrFail($equipo_id);
        $equipo->update(['estado' => 'No asignado']);

        return redirect()->route('asignacionesequipos.index')
            ->with('success', 'Asignación de equipo eliminada correctamente');
    }
}
