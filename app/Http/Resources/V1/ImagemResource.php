<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class ImagemResource extends JsonResource
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
            'url' => $this->url,
            'dataCriacao' => $this->created_at->format(config('app.datetime_format')),
            'dataEdicao' => $this->updated_at ? $this->updated_at->format(config('app.datetime_format')) : null,
            'dataExclusao' => $this->deleted_at ? $this->deleted_at->format(config('app.datetime_format')) : null
        ];
    }
}
