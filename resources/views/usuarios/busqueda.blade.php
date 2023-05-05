@extends('layout/template')

@section('title', 'Buscar Usuario')

@section('contenido')

<main>
    <div class="container py-4">
        <h2>Busqueda</h2>
        <a href="{{ url('usuarios') }}" class="btn btn-secondary p-2 my-3">Volver</a>

        <form action="{{ url('/usuarios/buscar') }}" method="post">
            @csrf
            <div class="mb-3 row">
                <label for="cedula" class="col-sm-2 col-form-label">Cédula</label>
                <div class="col-sm-5">
                    <input type="tel" name="cedula" id="cedula" pattern="[0-9]{10}" required  placeholder="Cédula" class="form-control" value="{{ old('cedula') }}">
                </div>
            </div>
            <button type="submit" class="btn btn-success p-2 my-3">Buscar</button>
          </form>

    @if($mostrar)
      <table class="table table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre Completo</th>
            <th>Cédula</th>
            <th>Email</th>
            <th>País</th>
            <th>Dirección</th>
            <th>Celular</th>
            <th>Categoría</th>
            <th></th>
            <th></th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>{{ $usuario->id }}</td>
            <td>{{ $usuario->nombres . " " . $usuario->apellidos }}</td>
            <td>{{ $usuario->cedula }}</td>
            <td>{{ $usuario->email }}</td>
            <td>{{ $usuario->pais }}</td>
            <td>{{ $usuario->direccion }}</td>
            <td>{{ $usuario->celular }}</td>
            <td>{{ $usuario->Tipo->categoria }}</td>
            <td><a href="{{ url('usuarios/' . $usuario->id .'/edit') }}" class="btn btn-warning btn-sm">Actualizar</a></td>
            <td>
              <form action="{{ url('usuarios/' . $usuario->id) }}" method="post">
                @method("DELETE")
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
              </form>
            </td>
          </tr>
        </tbody>
      </table>
      @endif
    </div>
</main>