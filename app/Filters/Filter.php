<?php

namespace App\Filters;

use Illuminate\Http\Request;

//Classe base de filtragem de dados que sera utilizada por toda a API
class Filter{

    //parametros que serao recebíveis na classe que herdar esta
    protected $parms = [];

    //mapeando parametros enviados pra achar a coluna no banco
    protected $colMap = [];

    //mapeando operadores que serão suportados para filtragem (=,<,<=,>,>=) => (eq,lt,leq,gt,get)
    protected $opMap = [];

    public function transform(Request $request){

        $eloQuery = [];

        //$p = nome do campo
        //$op = operador de pesquisa que ele pode estar usando (gt,lt,ne,eq)
        foreach($this->parms as $p => $op){
            $query = $request->query($p);

            if(!isset($query)){
                continue;
            }

            $column = $this->colMap[$p] ?? $p;

            //monta um array no estilo [] = ['campo','operador','valorQueryString'], da forma que é tratada pelo eloquent
            foreach($op as $o){
                if(isset($query[$o])){
                    $eloQuery[] = [$column,$this->opMap[$o],$query[$o]];
                }
            }
            
        }
        return $eloQuery;
    }


}