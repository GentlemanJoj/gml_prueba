<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
