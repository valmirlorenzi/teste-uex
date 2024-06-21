<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ContatoResource;
use App\Models\Contato;

class ContatoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ContatoResource::collection(Contato::all());
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
        $contato = new Contato;
        $contato->nome = $request->nome;
        $contato->cpf = $request->cpf;
        $contato->telefone = $request->telefone;
        $contato->cep = $request->cep;
        $contato->endereco = $request->endereco;
        $contato->numero = $request->numero;
        $contato->complemento = $request->complemento;
        $contato->lat_long = $request->latlong;
        $contato->save();
        return redirect("/contatos")->with('msg', 'Contato incluído com sucesso');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //return new ContatoResource(Contato::where('id', $id)->first());
        $contato = Contato::select('contatos.*', 'bairros.nome AS nome_bairro', 'cidades.nome AS nome_cidade', 'cidades.uf', 'users.name AS nome_usuario')
                        ->leftJoin('bairros', 'bairros.id', '=', 'contatos.id_bairro')
                        ->leftJoin('cidades', 'cidades.id', '=', 'bairros.id_cidade')
                        ->leftJoin('users', 'users.id', '=', 'contatos.id_usuario')
                        ->where('contatos.id', $id)
                        ->first();
        return $contato;
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
    public function update($id, Request $request)
    {
        $contato = Contato::findOrFail($id);
        $contato->nome = $request->nome;
        $contato->cpf = $request->cpf;
        $contato->telefone = $request->telefone;
        $contato->cep = $request->cep_;
        $contato->endereco = $request->endereco;
        $contato->numero = $request->numero;
        $contato->complemento = $request->complemento;
        $contato->lat_long = $request->latlong;
        $contato->update();
        return redirect("/contatos")->with('msg', 'Contato editado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contato = Contato::where('id', $id)->firstorfail()->delete();
        return $contato;
    }
    
    
    /**
     * Lê os contatos cadastrados do usuário logado e os retorna em uma lista para a opção CONTATOS
     */
    public function lista() {
//        $contatos = ContatoResource::collection(Contato::all()->sortBy('nome'));
        $contatos = Contato::select('contatos.*', 'bairros.nome AS nome_bairro', 'cidades.nome AS nome_cidade', 'cidades.uf', 'users.name AS nome_usuario')
                        ->leftJoin('bairros', 'bairros.id', '=', 'contatos.id_bairro')
                        ->leftJoin('cidades', 'cidades.id', '=', 'bairros.id_cidade')
                        ->leftJoin('users', 'users.id', '=', 'contatos.id_usuario')
                        ->orderBy('contatos.nome')
                        ->get();
        
        return view('lista-contatos', ['contatos' => $contatos]);
    }
    
    /**
     * Lê os contatos cadastrados do usuário logado e os retorna em uma lista para a opção LISTA DE CONTATOS
     */
    public function visualizacao() {
        $contatos = Contato::select('contatos.*', 'bairros.nome AS nome_bairro', 'cidades.nome AS nome_cidade', 'cidades.uf', 'users.name AS nome_usuario')
                        ->leftJoin('bairros', 'bairros.id', '=', 'contatos.id_bairro')
                        ->leftJoin('cidades', 'cidades.id', '=', 'bairros.id_cidade')
                        ->leftJoin('users', 'users.id', '=', 'contatos.id_usuario')
                        ->orderBy('contatos.nome')
                        ->get();
        
        return view('visualizacao-contatos', ['contatos' => $contatos]);
    }
    
}
