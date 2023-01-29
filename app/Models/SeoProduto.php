<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
* @property int id
* @property string titulo
* @property string link 
* @property string descricao 
*/
class SeoProduto extends Model
{
    use HasFactory;
    use SoftDeletes; 

    public $table = "seo_produto";

    protected $fillable  = [
        'titulo',
        'link',
        'descricao',
    ];

    protected $casts = [
        'titulo' => 'string',
        'link' => 'string',
        'descricao' => 'string',
    ];

    public function Produto(){
        return $this->hasOne(Produto::class);
    }

}
