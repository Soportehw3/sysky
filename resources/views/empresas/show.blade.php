    <h1>Detalles de la Empresa</h1>
    <p>ID: {{ $empresa->id }}</p>
    <p>Nombre: {{ $empresa->nombre }}</p>
    <a href="{{ route('empresas.edit', $empresa->id) }}">Editar</a>
    <form action="{{ route('empresas.destroy', $empresa->id) }}" method="POST" style="display:inline">
        @csrf
        @method('DELETE')
        <button type="submit">Eliminar</button>
    </form>
    <a href="{{ route('empresas.index') }}">Volver a la lista</a>
