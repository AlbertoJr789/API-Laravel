<?php

namespace App\Http\Requests\V1;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProdutoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nome' => 'required|max:255',
            'marca' => 'nullable',
            'precoCusto' => 'numeric|nullable',
            'precoVenda' => 'numeric|nullable',
            'precoPromocional' => 'numeric|nullable',
            'situacao' => 'required|in:0,1',
            'estoque' => 'required|integer',
            'sobConsulta' => 'required|in:0,1',
            'gtin' => 'nullable',
            'mpn' => 'nullable',
            'ncm' => 'nullable',
            'disponibilidade' => 'required|integer',
            'linkVideo' => 'nullable',
            'pacote' => 'required|integer',
            'seo' => 'required|integer'
        ];
    }

    protected function prepareForValidation()
    {
        //adapta os campos às tabelas do banco
        $this->merge([
            'preco_custo' => $this->precoCusto,
            'preco_venda' => $this->precoVenda,
            'preco_promocional' => $this->precoPromocional,
            'sob_consulta' => $this->sobConsulta,
            'link_video' => $this->linkVideo,
            'pacote_id' => $this->pacote,
            'seo_id' => $this->seo,
        ]);
    }

}
