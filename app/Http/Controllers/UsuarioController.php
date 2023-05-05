<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Events\UsuarioCreado;
use PhpParser\Node\Expr\Empty_;

use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\assertIsNotObject;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mostrar = true;
        if (Usuario::all()->isEmpty()) {
            $mostrar = false;
            return view("usuarios.index", ['mostrar' => $mostrar]);
        }
        $usuarios = Usuario::all();
        return view("usuarios.index", ['usuarios' => $usuarios, 'mostrar' => $mostrar]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();
        $paises = ApiController::obtenerPaises();
        return view("usuarios.create", ['categorias' => $categorias, 'paises' => $paises]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'nombres' => 'required|regex:/^[a-zA-Z\s]*$/u|min:5|max:100',
            'apellidos' => 'required|regex:/^[a-zA-Z\s]*$/u|max:100',
            'cedula' => 'required|regex:/^[0-9]*$/|size:10|unique:usuarios',
            'email' => 'required|email|max:150|unique:usuarios',
            'pais' => 'required',
            'direccion' => 'required|string|max:180',
            'celular' => 'required|regex:/^[0-9]*$/|size:10',
            'categoria' => 'required'
        ]);

        $usuario = new Usuario();
        $usuario->Asignar($request);
        $usuario->save();

        //Generación de evento
        event(new UsuarioCreado($usuario));

        return view("usuarios.message", ['msg' => 'Registro guardado']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //Devuelve 0 en caso de error
        $id = intval($id);
        if ($id == 0) {
            return view('/usuarios.message', ['msg' => 'Id inválido']);
        }

        $usuario = Usuario::find($id);
        if (!$usuario) {
            return view('/usuarios.message', ['msg' => 'Id no encontrado']);
        }

        $paises = ApiController::obtenerPaises();
        return view('usuarios.edit', ['usuario' => $usuario, 'categorias' => Categoria::all(), 'paises' => $paises]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validation = $request->validate([
            'nombres' => 'required|regex:/^[a-zA-Z\s]*$/u|min:5|max:100',
            'apellidos' => 'required|regex:/^[a-zA-Z\s]*$/u|max:100',
            'cedula' => 'required|regex:/^[0-9]*$/|size:10|unique:usuarios,cedula,' . $id,
            'email' => 'required|email|max:150|unique:usuarios,email,' . $id,
            'pais' => 'required',
            'direccion' => 'required|string|max:180',
            'celular' => 'required|regex:/^[0-9]*$/|size:10',
            'categoria' => 'required'
        ]);

        $usuario = Usuario::find($id);
        $usuario->Asignar($request);
        $usuario->save();

        return view("usuarios.message", ['msg' => 'Registro actualizado']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //Devuelve 0 en caso de error
        $id = intval($id);
        if ($id == 0) {
            return view('/usuarios.message', ['msg' => 'Id inválido']);
        }

        $usuario = Usuario::find($id);
        if (!$usuario) {
            return view('/usuarios.message', ['msg' => 'Id no encontrado']);
        }

        $usuario->delete();
        return redirect("usuarios");
    }

    public static function usuariosPorPais()
    {
        $usuarios = DB::select("SELECT pais,
        COUNT(id) as 'total'
        FROM usuarios
        GROUP BY pais;");

        return $usuarios;
    }
}
