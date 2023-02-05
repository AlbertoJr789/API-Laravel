<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoriaResource extends JsonResource
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
            'categoriaPai' => $this->categoria_pai_id,
            'dataCriacao' => $this->created_at->format(config('app.datetime_format')),
            'dataEdicao' => $this->updated_at ? $this->updated_at->format(config('app.datetime_format')) : null,
            'dataExclusao' => $this->deleted_at ? $this->deleted_at->format(config('app.datetime_format')) : null
        ];
    }
}
