<?php

namespace App\Http\Requests\V1;

use App\Models\Categoria;
use App\Models\Pacote;
use App\Rules\PacoteProdutoRule;
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
            'marca' => 'nullable|string',
            'precoCusto' => 'numeric|nullable',
            'precoVenda' => 'numeric|nullable',
            'precoPromocional' => 'numeric|nullable',
            'situacao' => 'required|in:0,1',
            'estoque' => 'required|integer',
            'sobConsulta' => 'required|in:0,1',
            'gtin' => 'nullable|string',
            'mpn' => 'nullable|string',
            'ncm' => 'nullable|string',
            'disponibilidade' => 'required|integer',
            'linkVideo' => 'nullable|string',
            'pacote' => ['required', new PacoteProdutoRule],
            'seo' => 'required',
            'seo.link' => 'required|string',
            'seo.titulo' => 'required|string',
            'seo.descricao' => 'required|string',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (is_numeric($this->input('pacote'))) {
                if (!Pacote::find($this->input('pacote'))) {
                    $id = $this->input('pacote');
                    $validator->errors()->add('pacote', "ID do pacote '$id' não existe");
                }
            }
            //validando as categorias
            if ($this->input('categoria') != null) {
                foreach ($this->input('categoria') as $categoria) {
                    $this->validarCategoria($validator, $categoria);
                }
            }
        });
    }

    private function validarCategoria($validator, $categoria)
    {
        if (!isset($categoria['id'])) {
            $nome = $categoria['nome'];
            if (Categoria::where('nome', strtolower($nome))->exists()) {
                $validator->errors()->add('categorias', "Categoria '$nome' já existe");
            }
            if (!is_numeric($categoria['categoriaPai']) && $categoria['categoriaPai'] != null) {
                $this->validarCategoria($validator, $categoria['categoriaPai']);
            }
        }
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
            'categoria_pai_id' => $this->categoriaPai,
        ]);
    }
}
