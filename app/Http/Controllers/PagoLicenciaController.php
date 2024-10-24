<?php

namespace App\Http\Controllers;

use App\Models\Licencia;
use App\Models\PagoLicencia;
use Illuminate\Http\Request;

class PagoLicenciaController extends Controller
{
    public function index($licenciaId)
    {
        $licencia = Licencia::findOrFail($licenciaId);
        $pagos = $licencia->pagos;

        return view('pagos.index', compact('licencia', 'pagos'));
    }

    public function create($licenciaId)
    {
        $licencia = Licencia::findOrFail($licenciaId);
        return view('pagos.create', compact('licencia'));
    }

    public function store(Request $request, $licenciaId)
    {
        $request->validate([
            'monto' => 'required|numeric',
            'fecha_pago' => 'required|date',
            'detalle' => 'nullable|string',
        ]);

        PagoLicencia::create([
            'licencia_id' => $licenciaId,
            'monto' => $request->monto,
            'fecha_pago' => $request->fecha_pago,
            'detalle' => $request->detalle,
        ]);

        return redirect()->route('licencias.pagos.index', $licenciaId)
                         ->with('success', 'Pago registrado exitosamente.');
    }
}
