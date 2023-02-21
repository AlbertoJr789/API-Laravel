<?php

namespace App\Filters\V1;

use App\Filters\Filter;
use Illuminate\Http\Request;

class ProdutoFilter extends Filter {

    protected $parms = [
        'id' => ['eq'],
        'nome' => ['eq','like'],
        'precoCusto' => ['eq','lt','lte','gt','gte'],
        'precoVenda' => ['eq','lt','lte','gt','gte'],
        'precoPromocional' => ['eq','lt','let','gt','gte'],
        'situacao' => ['eq'],
        'estoque' => ['eq','lt','lte','gt','gte'],
        'sobConsulta' => ['eq'],
        'gtin' => ['eq'],
        'mpn' => ['eq'],
        'ncm' => ['eq'],
        'disponibilidade' => ['eq','lt','lte','gt','gte'],
        'categoria' => ['eq','lt','lte','gt','gte']
    ];

    protected $colMap = [
        'precoCusto' => 'preco_custo',
        'precoVenda' => 'preco_venda',
        'precoPromocional' => 'preco_promocional',
        'sobConsulta' => 'sob_consulta',
    ];

    protected $opMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
        'like' => 'like'
    ];

}