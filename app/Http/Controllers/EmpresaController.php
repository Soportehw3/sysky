<?php
namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    public function index()
    {
        // Implementar paginación de 10 elementos por página
        $empresas = Empresa::paginate(5);
        return view('empresas.index', compact('empresas'));
    }

    public function create()
    {
        return view('empresas.create');
    }

    public function store(Request $request)
    {
        // Validar la entrada
        $request->validate([
            'nombre' => 'required|max:50',
        ]);

        // Verificar si la empresa ya existe
        $empresaExistente = Empresa::where('nombre', $request->nombre)->first();
        if ($empresaExistente) {
            return redirect()->route('empresas.index')
                ->with('error', 'La empresa ya existe.');
        }

        // Crear la nueva empresa
        Empresa::create($request->all());

        return redirect()->route('empresas.index')
            ->with('success', 'Empresa creada exitosamente.');
    }

    public function show(Empresa $empresa)
    {
        return view('empresas.show', compact('empresa'));
    }

    public function edit(Empresa $empresa)
    {
        return view('empresas.edit', compact('empresa'));
    }

    public function update(Request $request, Empresa $empresa)
    {
        $request->validate([
            'nombre' => 'required|max:50',
        ]);

        $empresa->update($request->all());

        return redirect()->route('empresas.index')
            ->with('success', 'Empresa actualizada exitosamente.');
    }

    public function destroy(Empresa $empresa)
    {
        $empresa->delete();

        return redirect()->route('empresas.index')
            ->with('success', 'Empresa eliminada exitosamente.');
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
}
