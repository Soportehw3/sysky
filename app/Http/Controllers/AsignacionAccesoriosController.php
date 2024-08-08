<?php

namespace App\Http\Controllers;

use App\Models\AsignacionesAccesorios;
use App\Models\Empleado;
use App\Models\Accesorio;
use App\Models\Acciones;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\LowStockNotification;
use Illuminate\Support\Facades\Notification;



class AsignacionAccesoriosController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sortField = $request->input('sort', 'created_at');
        $sortOrder = $request->input('order', 'desc');

        $asignacionesaccesorios = AsignacionesAccesorios::with(['empleado', 'accesorio', 'usuario'])
            ->when($search, function ($query, $search) {
                return $query->whereHas('empleado', function ($q) use ($search) {
                    $q->where('nombre', 'like', "%{$search}%");
                })->orWhereHas('accesorio', function ($q) use ($search) {
                    $q->where('descripcion', 'like', "%{$search}%");
                })->orWhere('fecha_asignacion', 'like', "%{$search}%")
                    ->orWhere('ticket', 'like', "%{$search}%");
            })
            ->orderBy($sortField, $sortOrder)
            ->paginate(10);

        return view('asignacionaccesorios.index', compact('asignacionesaccesorios', 'search', 'sortField', 'sortOrder'));
    }

    public function create()
    {
        $empleados = Empleado::all();
        $accesorios = Accesorio::all();
        $usuarios = User::all();
        return view('asignacionaccesorios.create', compact('empleados', 'accesorios', 'usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'empleado_id' => 'required|exists:empleados,id',
            'accesorio_id' => 'required|exists:accesorios,id',
            'cantidad_asignada' => 'required|integer|min:1',
            'fecha_asignacion' => 'required|date',
            'ticket' => 'required|integer',
            'nota_descriptiva' => 'nullable|string|max:100',
        ]);

        $accesorio = Accesorio::find($request->input('accesorio_id'));

        // Verifica si hay suficientes accesorios disponibles
        if ($accesorio->cantidad < $request->input('cantidad_asignada')) {
            return redirect()->back()->withErrors(['cantidad_asignada' => 'No hay suficientes accesorios disponibles.']);
        }

        // Crear la asignación de accesorio
        $asignacion = new AsignacionesAccesorios();
        $asignacion->accesorio_id = $request->input('accesorio_id');
        $asignacion->empleado_id = $request->input('empleado_id');
        $asignacion->cantidad_asignada = $request->input('cantidad_asignada');
        $asignacion->fecha_asignacion = $request->input('fecha_asignacion');
        $asignacion->usuario_responsable = Auth::id(); // Establecer el usuario autenticado
        $asignacion->ticket = $request->input('ticket');
        $asignacion->nota_descriptiva = $request->input('nota_descriptiva');

        $asignacion->save();

        // Disminuir la cantidad de accesorios disponibles
        $accesorio->cantidad -= $request->input('cantidad_asignada');
        $accesorio->save();

        // Comprobar si la cantidad es menor a la cantidad mínima y enviar notificación si es necesario
        if ($accesorio->cantidad <= $accesorio->cantidad_minima) {
            $this->sendLowStockNotification($accesorio);
        }

        // Registrar la acción
        $accion = new Acciones();
        $accion->modulo = "Accesorios";
        $accion->descripcion = "Se creó la asignación del accesorio: " . $asignacion->accesorio->descripcion . " para el empleado: " . $asignacion->empleado->nombre . " " . $asignacion->empleado-> apellidoP . " " .$asignacion->empleado-> apellidoM;
        $accion->usuario_responsable_id = Auth::id();
        $accion->created_at = Carbon::now('America/Mexico_City')->toDateTimeString();
        $accion->save();

        return redirect()->route('asignacionaccesorios.index')
            ->with('success', 'Asignación de accesorio creada con éxito.');
    }

    public function show(AsignacionesAccesorios $asignacion)
    {
        return view('asignacionaccesorios.show', compact('asignacion'));
    }

    public function edit(AsignacionesAccesorios $asignacion)
    {
        $empleados = Empleado::all();
        $accesorios = Accesorio::all();
        $usuarios = User::all();
        return view('asignacionaccesorios.edit', compact('asignacion', 'empleados', 'accesorios', 'usuarios'));
    }

    public function update(Request $request, AsignacionesAccesorios $asignacion)
{
    $request->validate([
        'empleado_id' => 'required|exists:empleados,id',
        'accesorio_id' => 'required|exists:accesorios,id',
        'cantidad_asignada' => 'required|integer|min:1',
        'fecha_asignacion' => 'required|date',
        'ticket' => 'required|integer',
        'nota_descriptiva' => 'nullable|string|max:100',
    ]);

    $accesorio = Accesorio::find($request->input('accesorio_id'));

    // Calcular la diferencia de cantidad asignada
    $diferenciaCantidad = $request->input('cantidad_asignada') - $asignacion->cantidad_asignada;

    // Verificar si hay suficientes accesorios disponibles si la cantidad asignada ha aumentado
    if ($diferenciaCantidad > 0 && $accesorio->cantidad < $diferenciaCantidad) {
        return redirect()->back()->withErrors(['cantidad_asignada' => 'No hay suficientes accesorios disponibles.']);
    }

    // Actualizar la cantidad de accesorios disponibles
    $accesorio->cantidad -= $diferenciaCantidad;
    $accesorio->save();

    // Actualizar la asignación de accesorio
    $asignacion->accesorio_id = $request->input('accesorio_id');
    $asignacion->empleado_id = $request->input('empleado_id');
    $asignacion->cantidad_asignada = $request->input('cantidad_asignada');
    $asignacion->fecha_asignacion = $request->input('fecha_asignacion');
    $asignacion->usuario_responsable = Auth::id(); // Establecer el usuario autenticado
    $asignacion->ticket = $request->input('ticket');
    $asignacion->nota_descriptiva = $request->input('nota_descriptiva');

    $asignacion->save();

    // Comprobar si la cantidad es menor a la cantidad mínima y enviar notificación si es necesario
    if ($accesorio->cantidad <= $accesorio->cantidad_minima) {
        $this->sendLowStockNotification($accesorio);
    }

    // Registrar la acción
    $accion = new Acciones();
    $accion->modulo = "Accesorios";
    $accion->descripcion = "Se actualizó la asignación del accesorio: " . $asignacion->accesorio->descripcion . " para el empleado: " . $asignacion->empleado->nombre . " " . $asignacion->empleado-> apellidoP . " " .$asignacion->empleado-> apellidoM;
    $accion->usuario_responsable_id = Auth::id();
    $accion->created_at = Carbon::now('America/Mexico_City')->toDateTimeString();
    $accion->save();

    return redirect()->route('asignacionaccesorios.index')
        ->with('success', 'Asignación de accesorio actualizada con éxito.');
}

    public function destroy(AsignacionesAccesorios $asignacion)
    {
        $asignacion->delete();
        return redirect()->route('asignacionaccesorios.index')
            ->with('success', 'Asignación de accesorio eliminada con éxito.');
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function sendLowStockNotification($accesorio)
    {
        // Define el correo específico al que deseas enviar la notificación
        $toEmail = 'soporte.hw3@skytex.com.mx';

        // Enviar la notificación por correo
        Notification::route('mail', $toEmail)->notify(new LowStockNotification($accesorio));
    }
}
