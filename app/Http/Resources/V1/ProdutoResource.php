<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class ProdutoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'descricao' => $this->descricao,
            'precoCusto' => $this->preco_custo,
            'marca' => $this->marca,
            'precoVenda' => $this->preco_venda,
            'precoPromocional' => $this->preco_promocional,
            'situacao' => $this->situacao,
            'estoque' => $this->estoque,
            'sobConsulta' => $this->sob_consulta,
            'disponibilidade' => $this->disponibilidade,
            'sku' => $this->sku,
            'gtin' => $this->gtin,
            'mpn' => $this->mpn,
            'ncm' => $this->ncm,
            'linkVideo' => $this->link_video,
            'pacote' => new PacoteResource($this->Pacote),
            'seo' => new SeoResource($this->Seo),
            'imagem' => new ImagemCollection($this->Imagem),
            'categoria' => CategoriaResource::collection($this->whenLoaded('categoria')),
            'dataCriacao' => $this->created_at->format(config('app.datetime_format')),
            'dataEdicao' => $this->updated_at ? $this->updated_at->format(config('app.datetime_format')) : null,
            'dataExclusao' => $this->deleted_at ? $this->deleted_at->format(config('app.datetime_format')) : null
        ];
    }
}
