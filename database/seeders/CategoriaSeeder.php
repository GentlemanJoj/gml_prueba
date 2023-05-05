<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoriaSeeder extends Seeder
{
    /**
     * Se ingresa a base de datos las categorias de usuarios.
     */
    public function run(): void
    {
        $categorias = ['Cliente', 'Proveedor', 'Funcionario Interno'];

        foreach ($categorias as $categoria) {
            DB::table('categorias')->insert([
                'categoria' => $categoria
            ]);
        }
    }
}
