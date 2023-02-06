<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/** 
* @property int id
* @property string nome
* @property integer categoria_pai_id 
*/
class Categoria extends Model
{
    use HasFactory;
    use SoftDeletes; 

    public $table = "categoria";

    protected $fillable  = [
        'nome',
        'categoria_pai_id'
    ];

    protected $casts = [
        'id' => 'integer',
        'categoria_pai_id' => 'integer',
    ];

    public function produto(){
        return $this->belongsToMany(Produto::class);
    }

    public function pai(){
        return $this->belongsTo(Categoria::class,'categoria_pai_id');
    }

}
