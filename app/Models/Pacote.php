<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/** 
* @property int id
* @property float peso
* @property float altura 
* @property float largura 
* @property float profundidade 
*/

class Pacote extends Model
{
    use HasFactory;
    use SoftDeletes; 

    public $table = "pacote";

    protected $fillable  = [
        'peso',
        'altura',
        'largura',
        'profundidade',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $casts = [

        'peso' => 'float',
        'altura' => 'float',
        'largura' => 'float',
        'profundidade' => 'float',
    ];


    public function Produto(){
        return $this->hasMany(Produto::class);
    }


}
