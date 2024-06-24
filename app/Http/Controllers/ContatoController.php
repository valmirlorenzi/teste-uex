<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ContatoResource;
use App\Models\Contato;
use App\Models\Cidade;
use App\Models\Bairro;

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
      // verificar se o cadastro de bairro e cidade existem 
        $this->verificarCidade($request->cidade, $request->uf);
        $cidade = Cidade::select('id', 'nome', 'uf')->where('nome', $request->cidade)->where('uf', $request->uf)->first(); // agora deve existir
        $this->verificarBairro($request->bairro, $cidade->id);
        $bairro = Bairro::select('id', 'nome', 'id_cidade')->where('id_cidade', $cidade->id)->where('nome', $request->bairro)->first(); // agora deve existir
        
        $contato = new Contato;
        $contato->id_usuario = $request->id_usuario;
        $contato->nome = $request->nome;
        $contato->cpf = $request->cpf;
        $contato->telefone = $request->telefone;
        $contato->cep = $request->cep;
        $contato->endereco = $request->endereco;
        $contato->numero = $request->numero;
        $contato->complemento = $request->complemento;
        $contato->id_bairro = $bairro->id;
        $contato->lat_long = $request->latlong;
        $contato->save();
        $this->filtra(); // lê os contatos e gera HTML para mostrar na tela de contatos
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return Contato::all();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $contato = Contato::select('contatos.*', 'bairros.nome AS nome_bairro', 'cidades.nome AS nome_cidade', 'cidades.uf', 'users.name AS nome_usuario')
                        ->leftJoin('bairros', 'bairros.id', '=', 'contatos.id_bairro')
                        ->leftJoin('cidades', 'cidades.id', '=', 'bairros.id_cidade')
                        ->leftJoin('users', 'users.id', '=', 'contatos.id_usuario')
                        ->where('contatos.id', $id)
                        ->first();
        return $contato;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
      // verificar se o cadastro de bairro e cidade existem 
        $this->verificarCidade($request->cidade, $request->uf);
        $cidade = Cidade::select('id', 'nome', 'uf')->where('nome', $request->cidade)->where('uf', $request->uf)->first(); // agora deve existir
        $this->verificarBairro($request->bairro, $cidade->id);
        $bairro = Bairro::select('id', 'nome', 'id_cidade')->where('id_cidade', $cidade->id)->where('nome', $request->bairro)->first(); // agora deve existir
        $contato = Contato::findOrFail($id);
        $contato->nome = $request->nome;
        $contato->cpf = $request->cpf;
        $contato->telefone = $request->telefone;
        $contato->cep = $request->cep;
        $contato->endereco = $request->endereco;
        $contato->numero = $request->numero;
        $contato->complemento = $request->complemento;
        $contato->lat_long = $request->latlong;
        $contato->id_bairro = $bairro->id;
        $contato->update();
        $this->filtra(); // lê os contatos e gera HTML para mostrar na tela de contatos
    }
    /**
     * Verifica se a cidade está cadastrada, pelo nome e UF... se não estiver, inclui
     */
    private function verificarCidade($nome, $uf) {
        $cidade = Cidade::select('id', 'nome', 'uf')->where('nome', $nome)->where('uf', $uf)->first();
        if(!$cidade) { // cidade não existe, cadastrar
            $cidade = new Cidade;
            $cidade->nome = $nome;
            $cidade->uf = $uf;
            $cidade->save();
        }
    }
        
    /**
     * Verifia se o bairro está cadastrado, pelo nome e cidade... se não estiver, inclui
     */
    private function verificarBairro($nome, $idCidade) {
        $bairro = Bairro::select('id', 'nome', 'id_cidade')->where('id_cidade', $idCidade)->where('nome', $nome)->first();
        if(!$bairro) { // bairro não existe, cadastrar
            $bairro = new Bairro;
            $bairro->nome = $nome;
            $bairro->id_cidade = $idCidade;
            $bairro->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, Request $request)  {
//        if($senha == Auth::user->password()) { // TODO VER
            $contato = Contato::where('id', $id)->firstorfail()->delete();
            return $contato;
//        }
//        else {
//            return false;
//        }
    }
    
    /**
     * Lê os contatos cadastrados do usuário logado que corresponda ao filtro e os retorna em uma lista para a opção VISUALIZAÇÃO DE CONTATOS
     */
    public function filtra($tipoContato = "", $texto = "") {
        $contatos = $this->lerContatos($tipoContato, $texto);
        $tipo = "visualizacao"; // para não colocar botões de editar e excluir
        include('../resources/views/lista-contato.php');
    }
        
    /**
     * Lê os contatos cadastrados do usuário logado e os retorna em uma lista para a opção CONTATOS
     */
    public function lista() {
        $contatos = $this->lerContatos();
        return view('lista-contatos', ['contatos' => $contatos]);
    }
    
    private function lerContatos($tipoContato = "", $texto = "") {
//        $contatos = ContatoResource::collection(Contato::all()->sortBy('nome'));
        $contatos = Contato::select('contatos.*', 'bairros.nome AS nome_bairro', 'cidades.nome AS nome_cidade', 'cidades.uf', 'users.name AS nome_usuario')
                        ->leftJoin('bairros', 'bairros.id', '=', 'contatos.id_bairro')
                        ->leftJoin('cidades', 'cidades.id', '=', 'bairros.id_cidade')
                        ->leftJoin('users', 'users.id', '=', 'contatos.id_usuario')
                        ->orderBy('contatos.nome')
                        ->orWhereRaw("CONCAT(ifnull(contatos.nome,''),' ',ifnull(contatos.cpf,''),' ',ifnull(contatos.telefone,''),' ',ifnull(contatos.endereco,''),' ',ifnull(bairros.nome,''),' ',ifnull(cidades.nome,''),' ',ifnull(contatos.cep,'')) LIKE '%{$texto}%' ")
                        ->get();
        return $contatos;
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
