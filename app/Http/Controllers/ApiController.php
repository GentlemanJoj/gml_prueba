<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public static function obtenerPaises()
    {
        $url = env('PAISES_API', 'https://restcountries.com/v3.1');
        $response = Http::get($url . '/subregion/South America');
        $datos = $response->json();
        $paises = [];
        foreach ($datos as $dato) {
            $paises[] = $dato['name']['common'];
        }
        return $paises;
    }
}
