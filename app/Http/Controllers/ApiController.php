<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    /**
     * Obtener paises de la región 'South America'
     */
    public static function obtenerPaises()
    {
        //Se trae la url de las variables en configuración
        $url = env('PAISES_API', 'https://restcountries.com/v3.1');
        $response = Http::get($url . '/subregion/South America');
        //Convertir resultado en json
        $datos = $response->json();
        $paises = [];
        //Asignar a un arreglo para retornarlo
        foreach ($datos as $dato) {
            $paises[] = $dato['name']['common'];
        }
        return $paises;
    }
}
