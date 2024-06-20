<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViaCepController extends Controller
{
    /**
     * Buscar dados do CEP na API VIACEP
     */
    public function show(string $cep)
    {
        $cep = str_replace([".", "-"], "", $cep);
        if(strlen($cep) != 8) {
            return false;
        }
        else {
            return file_get_contents("https://viacep.com.br/ws/{$cep}/json/");
        }
    }
}
