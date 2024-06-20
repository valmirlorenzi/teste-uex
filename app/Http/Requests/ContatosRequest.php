<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContatosRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        switch($this->method()) {
            case 'POST':
                return [
                    'id_usuario' => "required",
                    'nome' => "required",
                    'cpf' => "required|max:15|unique=contatos",
                    'telefone' => "required|max:15",
                    'endereco' => "required|max:60",
                    'numero' => "required|max:10",
                    'cep' => "required|max:9",
                    'id_bairro' => "required",
                    
                ];
                break;
            case 'PUT':
                return [
                    'id_usuario' => "required",
                    'nome' => "required",
                    'cpf' => "required|max:15|unique=contatos,cpf,{$this->id}",
                    'telefone' => "required|max:15",
                    'endereco' => "required|max:60",
                    'numero' => "required|max:10",
                    'cep' => "required|max:9",
                    'id_bairro' => "required",
                ];
                break;
            default:
                break;
        }
        return [
            //
        ];
    }
}

