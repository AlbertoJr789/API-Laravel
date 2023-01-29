<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/** 
* @property int id
* @property string url
* @property integer produto_id 
*/
class ImagemProduto extends Model
{
    use HasFactory;
    use SoftDeletes; 

    public $table = "imagem_produto";

    protected $fillable  = [
        'url',
        'produto_id'
    ];

    protected $casts = [
        'url' => 'string',
        'produto_id' => 'integer',
    ];

    public function produto(){
        return $this->belongsToMany(Produto::class);
    }

}
