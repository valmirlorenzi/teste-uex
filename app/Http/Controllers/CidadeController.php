<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cidade;


class CidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Cidade::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    
    /**
     * Pega somente as UFs da tabela de cidades (para os SELECT)
     */
    public function pegarUFS() {
        //return Cidade::select('uf')->distinct()->get()->sortBy('uf');        
        return ['AC', 'AL', 'AM', 'AP', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MG', 'MS', 'MT', 'PA', 'PB', 'PE', 'PI', 'PR', 'RJ', 'RN', 'RO', 'RR', 'RS', 'SC', 'SE', 'SP', 'TO'];
    }
    
    /**
     * Pega as cidades de determinada UF
     */
    public function pegarCidades($uf, $texto) {
        return Cidade::all()
                ->where('uf', $uf);
//                ->where('uf', 'LIKE', "'%curitiba%'"); // TODO VER
    }
    
}
