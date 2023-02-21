<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
    Versão 9.48.1
<p>

# ModerniZ-API

## [Documentação](https://docs.google.com/document/d/1PGPLBDSXh5zsPUWpLjjr4X3nKOksqdv6UXW-PI07PKk/edit)

# Instruções

Criando model com a porra toda (Resourcer Controllers, Migrations etc.)

    php artisan make:model <nome> --all

Criando Factories

    php artisan make:factory ProdutoFactory

    Aqui dentro, será feito a geração de registros fakes para o banco, utilizadn o Faker

Criando Seeders

    php artisan make:seeder ProdutoSeeder

Seeders nos auxiliarão a utilizar as Factories para criação dos dados fakes, por meio de sua chamada no terminal:

    php artisan db:seed

---

## Rotas Resources API com Versionamento

Método apiResource: providencia todas as rotas de api de padrão RESTful, GET, PUT, PATCH, UPDATE e DELETE. Não é então necessário implementar endpoint por endpoint, basta seguir as convenções.

```php
Route::group(['prefix' => 'v1', 'namespace' =>   'App\Http\Controllers\V1'],function(){
        Route::apiResource('categorias',CategoriaController::class);
    });
```

Criando Resources para transformar a resposta dos endpoints em JSON.

    php artisan make:resource NomeResource

É possível criar um ResourceCollection para transformar a resposta de multiplos itens.

Filtros

Cria-se uma classe pai Filters em App\Filters, depois os arquivos ´Entidade`Filter que herdarão esta classe. Como, por exemplo, ProdutoFilter:

```php

class ProdutoFilter extends Filter {

    protected $parms = [
        'id' => ['eq'],
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
    ];

}

```

ProdutoFilter implementará apenas os paramêtros que o objeto suporta.

Haverá um método transform(), que montará as condiçoes dentro da cláusula where do eloquent

```php

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
                    if($this->opMap[$o] == 'like')
                        $eloQuery[] = [$column,'like',"%$query[$o]%"];
                    else
                        $eloQuery[] = [$column,$this->opMap[$o],$query[$o]];
                }
            }

        }
        return $eloQuery;
    }

```

Validação de registros

Será criado uma classe de requisição que tratará destas inserções

    php artisan make:request StoreProdutoRequest

Cada classe request possuirá regras de validações que serão executadas antes de iniciar o processamento dentro da função do controller. Obtendo sucesso, basta prosseguir com a lógica de criação do registro no banco de dados.

# Autenticação

Para autenticação, está sendo utilizado o Laravel [Sanctum](https://laravel.com/docs/10.x/sanctum). Foram definidas duas rotas públicas: Login e Cadastro.
