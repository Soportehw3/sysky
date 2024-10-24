<?php

namespace App\Http\Controllers;

use App\Models\Impresora;
use Illuminate\Http\Request;

class ImpresoraController extends Controller
{
    public function index()
    {
        $impresoras = Impresora::all();

        // Verificar el estado de cada impresora usando el método ping() de esta clase
        $impresoras->map(function ($impresora) {
            $impresora->estado = $this->ping($impresora->ip);  // Ajuste aquí
        });

        return view('impresoras.index', compact('impresoras'));
    }

    public function getEstados()
    {
        $impresoras = Impresora::all();

        foreach ($impresoras as $impresora) {
            $impresora->estado = $this->ping($impresora->ip) ? 'En linea' : 'Sin Red';
            $impresora->save(); // Guardar el nuevo estado
        }

        return response()->json($impresoras);
    }


    public function create()
    {
        return view('impresoras.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'marca' => 'required|string',
            'modelo' => 'required|string',
            'ip' => 'required|ip',
            'area' => 'required|string',
        ]);

        Impresora::create($request->all());
        return redirect()->route('impresoras.index')->with('success', 'Impresora registrada correctamente.');
    }

    public function edit(Impresora $impresora)
    {
        return view('impresoras.edit', compact('impresora'));
    }

    public function update(Request $request, Impresora $impresora)
    {
        $request->validate([
            'modelo' => 'required',
            'marca' => 'required',
            'area' => 'required',
            'ip' => 'required|ip',
        ]);

        $impresora->update($request->all());
        return redirect()->route('impresoras.index')->with('success', 'Impresora actualizada correctamente.');
    }

    public function show($id)
    {
        $impresora = Impresora::findOrFail($id);
        return view('impresoras.show', compact('impresora'));
    }




    function ping($host, $timeout = 1)
    {
        $output = null;
        $status = null;

        // Ejecuta ping basado en el sistema operativo
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            exec("ping -n 1 -w " . ($timeout * 1000) . " {$host}", $output, $status);
        } else {
            exec("ping -c 1 -W {$timeout} {$host}", $output, $status);
        }

        return $status === 0 ? 'En línea' : 'Sin Red';
    }

    public function updateEstado($id)
    {
        $impresora = Impresora::findOrFail($id);

        // Simulación de estado basado en un ping
        $enLinea = $this->realizarPing($impresora->ip);

        $impresora->estado = $enLinea ? 'En línea' : 'Sin red';
        $impresora->save(); // Asegúrate de guardar el estado actualizado

        return response()->json(['estado' => $impresora->estado]);
        if ($impresora->save()) {
            return "Estado actualizado correctamente.";
        } else {
            return "Error al actualizar el estado.";
        }
    }

}
