<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

//Se crea para poder usar Eloquent 
class Usuario extends Model
{
    use HasFactory;

    public $timestamps = false;

    //Perite obtener la información de la categoria, por medio de la FK
    public function Tipo()
    {
        return $this->belongsTo(Categoria::class, 'IdCategoria', 'id');
    }

    //Se asignan los valores pasados en el formulario
    public function Asignar(Request $request)
    {
        $this->nombres = $request->input('nombres');
        $this->apellidos = $request->input('apellidos');
        $this->cedula = $request->input('cedula');
        $this->email = $request->input('email');
        $this->pais = $request->input('pais');
        $this->direccion = $request->input('direccion');
        $this->celular = $request->input('celular');
        $this->IdCategoria = $request->input('categoria');
    }
}
