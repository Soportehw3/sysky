    <h1>Lista de Empresas</h1>
    <a href="{{ route('empresas.create') }}">Crear Nueva Empresa</a>

    @if ($message = Session::get('success'))
        <div>
            {{ $message }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($empresas as $empresa)
                <tr>
                    <td>{{ $empresa->id }}</td>
                    <td>{{ $empresa->nombre }}</td>
                    <td>
                        <a href="{{ route('empresas.show', $empresa->id) }}">Ver</a>
                        <a href="{{ route('empresas.edit', $empresa->id) }}">Editar</a>
                        <form action="{{ route('empresas.destroy', $empresa->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
