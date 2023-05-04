@extends('layout/template')

@section('title', 'Mensaje importante')

@section('contenido')

<main>
    <div class="container py-4">
        <h2>{{ $msg }}</h2>
        <a href="{{ url('usuarios') }}" class="btn btn-secondary p-2 my-3">Volver</a>
    </div>
</main>