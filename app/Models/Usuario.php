<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Usuario extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function Tipo()
    {
        return $this->belongsTo(Categoria::class, 'IdCategoria', 'id');
    }

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
