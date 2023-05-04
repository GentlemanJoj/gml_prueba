@extends('layout/template')

@section('title', 'Registrar usuario')

@section('contenido')

<main>
    <div class="container py-4">
        <h2>Registrar usuario</h2>
        <a href="{{ url('usuarios') }}" class="btn btn-primary p-2 my-3">Volver</a>

        @if($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ url('/usuarios') }}" method="post">
            @csrf

            <div class="mb-3 row">
                <label for="nombres" class="col-sm-2 col-form-label">Nombres</label>
                <div class="col-sm-5">
                    <input type="text" name="nombres" id="nombres" maxlength="100" minlength="5" pattern="[a-zA-Z\s]*" required  placeholder="Nombre(s)" class="form-control" value="{{ old('nombres') }}">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="apellidos" class="col-sm-2 col-form-label">Apellidos</label>
                <div class="col-sm-5">
                    <input type="text" name="apellidos" id="apellidos" maxlength="100" pattern="[a-zA-Z\s]*" required placeholder="Apellido(s)" class="form-control" value="{{ old('apellidos') }}">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="cedula" class="col-sm-2 col-form-label">Cédula</label>
                <div class="col-sm-5">
                    <input type="tel" name="cedula" id="cedula" pattern="[0-9]{10}" required  placeholder="Cédula" class="form-control" value="{{ old('cedula') }}">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-5">
                    <input type="email" name="email" id="email" maxlength="150" required placeholder="Email" class="form-control" value="{{ old('email') }}">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="pais" class="col-sm-2 col-form-label">País</label>
                <div class="col-sm-5">
                    <select name="pais" id="pais" class="form-select" required>
                        <option value="">--Seleccione un país--</option>
                        @foreach($paises as $pais)
                        <option value="{{$pais}}">{{ $pais }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="direccion" class="col-sm-2 col-form-label">Dirección</label>
                <div class="col-sm-5">
                    <input type="text" name="direccion" id="direccion" maxlength="180" required placeholder="Dirección" class="form-control" value="{{ old('direccion') }}">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="celular" class="col-sm-2 col-form-label">Celular</label>
                <div class="col-sm-5">
                    <input type="tel" name="celular" id="celular" pattern="[0-9]{10}" required placeholder="Celular" class="form-control" value="{{ old('celular') }}">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="categoria" class="col-sm-2 col-form-label">Categoría</label>
                <div class="col-sm-5">
                    <select name="categoria" id="categoria" class="form-select" required>
                        <option value="">--Seleccione una categoría--</option>
                        @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-success p-2 my-3">Registrar</button>
        </form>
    </div>
  </main>