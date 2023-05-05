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
     * Muestra la pantalla principal, con la lista de usuarios
     */
    public function index()
    {
        $mostrar = true;
        //Se pregunta si la lista de usuarios está vacía 
        if (Usuario::all()->isEmpty()) {
            $mostrar = false;
            //Se muestra la vista, con un mensaje correspondiente
            return view("usuarios.index", ['mostrar' => $mostrar]);
        }
        $usuarios = Usuario::all();
        //Se muestra la vista, con los datos 
        return view("usuarios.index", ['usuarios' => $usuarios, 'mostrar' => $mostrar]);
    }

    /**
     * Mostrar el formulario de creación 
     */
    public function create()
    {
        //Se obtienen todas las categorías de usuario
        $categorias = Categoria::all();
        //Se consulta al ApiController para obtener la lista de paises
        $paises = ApiController::obtenerPaises();
        return view("usuarios.create", ['categorias' => $categorias, 'paises' => $paises]);
    }

    /**
     * Guardar un usuario
     */
    public function store(Request $request)
    {
        //Validaciones necesarias 
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

        //Se crea un nuevo usuario, se asignan los valores y se guarda
        //en base de datos
        $usuario = new Usuario();
        $usuario->Asignar($request);
        $usuario->save();

        //Generación de evento por creación de usuario
        event(new UsuarioCreado($usuario));

        //Al crear se lleva a una vista con un mensaje de exito
        return view("usuarios.message", ['msg' => 'Registro guardado']);
    }

    /**
     * Mostrar el formulario de actualización 
     */
    public function edit($id)
    {
        //Devuelve 0 en caso de error
        $id = intval($id);
        if ($id == 0) {
            //En caso de no ser un int se redirige a la vista de message
            //con un mensaje correspondiente 
            return view('/usuarios.message', ['msg' => 'Id inválido']);
        }

        $usuario = Usuario::find($id);
        if (!$usuario) {
            //En caso de no encontrar ese id se redirige a la vista de message
            //con un mensaje correspondiente 
            return view('/usuarios.message', ['msg' => 'Id no encontrado']);
        }

        $paises = ApiController::obtenerPaises();
        //Si el id es un int y se encuentra, se muestra la vista de actualización 
        return view('usuarios.edit', ['usuario' => $usuario, 'categorias' => Categoria::all(), 'paises' => $paises]);
    }

    /**
     * Actualizar usuario
     */
    public function update(Request $request, $id)
    {
        //Validaciones necesarias 
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

        //Se crea un nuevo usuario, se asignan los valores y se guarda
        //en base de datos
        $usuario = Usuario::find($id);
        $usuario->Asignar($request);
        $usuario->save();

        //Al actulizar se lleva a una vista con un mensaje de exito
        return view("usuarios.message", ['msg' => 'Registro actualizado']);
    }

    /**
     * Eliminar un usuario
     */
    public function destroy($id)
    {
        //Validaciones adicionales 
        $id = intval($id);
        if ($id == 0) {
            return view('/usuarios.message', ['msg' => 'Id inválido']);
        }

        $usuario = Usuario::find($id);
        if (!$usuario) {
            return view('/usuarios.message', ['msg' => 'Id no encontrado']);
        }

        //Se elimina al usuario y se redirige a la vista principal
        $usuario->delete();
        return redirect("usuarios");
    }

    /**
     * Consultar cantidad de usuarios por país   
     */
    public static function usuariosPorPais()
    {
        //Retorna los usuarios por pais
        $usuarios = DB::select("SELECT pais,
        COUNT(id) as 'total'
        FROM usuarios
        GROUP BY pais;");

        return $usuarios;
    }

    /**
     * Muestra la vista de busqueda
     */
    public function busqueda()
    {
        //Se establece en falso para no mostrar la tabla con los resultados
        //la primera vez que se carga la vista
        $mostrar = false;
        return view('/usuarios.busqueda', ['mostrar' => $mostrar]);
    }

    /**
     * Busca un usuario por la cédula
     */
    public function buscar(Request $request)
    {
        //Validación necesaria
        $validation = $request->validate([
            'cedula' => 'required|regex:/^[0-9]*$/|size:10'
        ]);

        //Consulta
        $usuario = Usuario::where('cedula', '=', $request->input('cedula'))->first();

        if ($usuario == null) {
            //Se redirige a la vista message con un mensaje correspondiente 
            return view('/usuarios.message', ['msg' => 'Usuario no encontrado']);
        }

        //Se muestran los resultados 
        return view('/usuarios.busqueda', ['usuario' => $usuario, 'mostrar' => true]);
    }
}
