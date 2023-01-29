<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/** 
* @property int id
* @property string nome
* @property decimal preco_custo 
* @property decimal preco_venda 
* @property decimal preco_promocional 
* @property integer situacao (novo/usado) 
* @property integer estoque  
* @property boolean sob_consulta  
* @property string gtin  
* @property string mpn  
* @property string ncm  
* @property integer disponibilidade  
* @property string link_video  
* @property integer pacote_id
* @property integer seo_id
*/


class Produto extends Model
{
    use HasFactory;
    use SoftDeletes; 

    public $table = "produto";

    protected $with = ['pacote','seo'];

    protected $fillable  = [
        'nome',
        'preco_custo',
        'preco_venda',
        'preco_promocional',
        'situacao',
        'estoque',
        'sob_consulta',
        'gtin',
        'mpn',
        'ncm',
        'disponibilidade',
        'link_video',
        'pacote_id',
        'seo_id'
    ];

    protected $casts = [
        'nome' => 'string',
        'preco_custo' => 'double',
        'preco_venda' => 'double',
        'preco_promocional' => 'double',
        'situacao' => 'integer',
        'estoque' => 'integer',
        'sob_consulta' => 'boolean',
        'gtin' => 'string',
        'mpn' => 'string',
        'ncm' => 'string',
        'disponibilidade' => 'integer',
        'link_video' => 'string',
        'pacote_id' => 'integer',
        'seo_id' => 'integer'
    ];

    public function Categoria(){
       return $this->belongsToMany(Categoria::class)->withTimestamps();
    }

    public function Pacote(){
        return $this->belongsTo(Pacote::class);
    }

    public function Seo(){
        return $this->belongsTo(SeoProduto::class);
    }

    public function Imagem(){
        return $this->hasMany(ImagemProduto::class);
    }

}
