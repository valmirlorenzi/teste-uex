<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContatoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'id_usuario' => $this->id_usuario,
            'nome_usuario' => $this->nome_usuario,
            'cpf' => $this->cpf,
            'telefone' => $this->telefone,
            'endereco' => $this->endereco,
            'numero' => $this->numero,
            'complemento' => $this->complemento,
            'cep' => $this->cep,
            'id_bairro' => $this->id_bairro,
            'nome_bairro' => $this->nome_bairro,
            'nome_cidade' => $this->nome_cidade,
            'uf' => $this->uf,
            'latitude' => 'implementar',
            'longitude' => 'implementar',
        ];
    }
}
