@extends('layout/template')

@section('title', 'Inicio')

@section('contenido')

<main>
  <div class="container py-4">
      <h2>Lista de usuarios</h2>
      @if(!$mostrar)
      <p class="mt-3 mb-0">Todavía no hay usuarios, pruebe creando uno</p>
      @endif
      <a href="{{ url('usuarios/create') }}" class="btn btn-primary p-2 my-3">Crear usuario</a>

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
          @foreach($usuarios as $usuario)
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
          @endforeach
        </tbody>
      </table>
      @endif
  </div>
</main>