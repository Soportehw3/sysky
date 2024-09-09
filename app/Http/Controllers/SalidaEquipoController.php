<?php

namespace App\Http\Controllers;

use App\Models\Acciones;
use App\Models\SalidaEquipo;
use App\Models\Equipo;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;


class SalidaEquipoController extends Controller
{
    public function index(Request $request)
    {
        $query = SalidaEquipo::query();

        // Buscar por equipo o empleado
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->whereHas('equipo', function ($q) use ($search) {
                $q->where('etiqueta_skytex', 'LIKE', "%$search%");
            })->orWhereHas('empleado', function ($q) use ($search) {
                $q->where('nombre', 'LIKE', "%$search%")
                    ->orWhere('apellidoP', 'LIKE', "%$search%")
                    ->orWhere('apellidoM', 'LIKE', "%$search%");
            });
        }

        // Ordenar por fecha de creación en orden descendente
        $salidas = $query->orderBy('created_at', 'desc')->paginate(10)->appends($request->all());

        return view('salidas.index', compact('salidas'));
    }

    public function create()
    {
        $equipos = Equipo::all();
        $empleados = Empleado::all();
        return view('salidas.create', compact('equipos', 'empleados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'equipo_id' => 'required|exists:equipos,id',
            'empleado_id' => 'required|exists:empleados,id',
            'fecha_salida' => 'required|date',
            'nota_salida' => 'required|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagenNombre = null;
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $imagenNombre = time() . '_' . $imagen->getClientOriginalName();
            $imagen->move(public_path('images/salidas'), $imagenNombre);
        }

        $salida = SalidaEquipo::create([
            'equipo_id' => $request->equipo_id,
            'empleado_id' => $request->empleado_id,
            'fecha_salida' => $request->fecha_salida,
            'nota_salida' => $request->nota_salida,
            'imagen' => $imagenNombre,
            'usuario_responsable_id' => Auth::user()->id,  // Agregando usuario responsable
        ]);

        // Registrar la acción
        $accion = new Acciones();
        $accion->modulo = "Salida de Equipos";
        $accion->descripcion = "Se registró la salida del equipo con número de serie: " . $salida->equipo->numero_serie;
        $accion->usuario_responsable_id = Auth::user()->id;
        $accion->created_at = Carbon::now('America/Mexico_City')->toDateTimeString();
        $accion->save();

        return redirect()->route('salidas.index')->with('success', 'Salida registrada exitosamente.');
    }


    public function edit(SalidaEquipo $salida)
    {
        return view('salidas.edit', compact('salida'));
    }

    public function show($id)
    {
        $salida = SalidaEquipo::findOrFail($id);
        return view('salidas.show', compact('salida'));
    }

    public function update(Request $request, SalidaEquipo $salida)
    {
        $request->validate([
            'fecha_regreso' => 'required|date',
            'nota_regreso' => 'required|string',
            'imagen_regreso' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'fecha_regreso' => $request->fecha_regreso,
            'nota_regreso' => $request->nota_regreso,
        ];

        if ($request->hasFile('imagen_regreso')) {
            // Eliminar la imagen anterior si existe
            if ($salida->imagen_regreso) {
                Storage::disk('public')->delete($salida->imagen_regreso);
            }
            // Guardar la nueva imagen
            $data['imagen_regreso'] = $request->file('imagen_regreso')->store('imagenes_regresos', 'public');
        }

        $salida->update($data);

        // Registrar la acción
        $accion = new Acciones();
        $accion->modulo = "Regreso de Equipos";
        $accion->descripcion = "Se registró el regreso del equipo con número de serie: " . $salida->equipo->numero_serie;
        $accion->usuario_responsable_id = Auth::user()->id;
        $accion->created_at = Carbon::now('America/Mexico_City')->toDateTimeString();
        $accion->save();

        return redirect()->route('salidas.index')->with('success', 'Regreso registrado exitosamente.');
    }

    public function generarPDF($id)
    {
        $salida = SalidaEquipo::with(['empleado', 'equipo', 'usuarioResponsable'])->findOrFail($id);

        $pdf = FacadePdf::loadView('documentos.salida', compact('salida'));

        return $pdf->stream('Pase_de_Salida_' . $salida->id . '.pdf');
    }
}
