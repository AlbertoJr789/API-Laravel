<?php

namespace App\Filters\V1;

use App\Filters\Filter;
use Illuminate\Http\Request;

class CategoriaFilter extends Filter {

    protected $parms = [
        'id' => ['eq'],
        'nome' => ['like','eq']
    ];

    protected $opMap = [
        'eq' => '=',
        'like' => 'like'
    ];

}