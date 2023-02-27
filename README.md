<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
    Versão 9.48.1
<p>

# API Laravel

Este projeto se trata de uma implementação utilizando diversos recursos que a ferramenta é capaz de oferecer para auxiliar na produtividade ao se desenvolver uma API, que serão detalhadas mais para frente.

O projeto possui endpoints para cadastro de Produtos e Categorias, no qual possuem mapeamento N:N de relacionamento e Produtos possuem outros mapeamentos com outras entidades.

# Preparações do Projeto

Criando model com a porra toda (Resource Controllers, Migrations etc.)

    php artisan make:model <nome> --all

Criando Factories

    php artisan make:factory ProdutoFactory

    Aqui dentro, será feito a geração de registros fakes para o banco, utilizando o Faker

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

Utilizando filtros via url:

    produtos?estoque[gt]=57&precoCusto[lt]=2000

Buscará produtos com estoque maior que (greater than) 57 e que custam menos (less than) de 2000 reais

## Validação de registros

Será criado uma classe de requisição que tratará destas inserções

    php artisan make:request StoreProdutoRequest

Cada classe request possuirá regras de validações que serão executadas antes de iniciar o processamento dentro da função do controller. Obtendo sucesso, basta prosseguir com a lógica de criação do registro no banco de dados.

# Autenticação

Para autenticação, está sendo utilizado o Laravel [Sanctum](https://laravel.com/docs/10.x/sanctum). Foram definidas duas rotas públicas: Login e Cadastro.

Para geração do token (que seria cadastrar um usuário), deve-se enviar o payload via POST na rota /api/cadastro:

```json
{
    "nome": "Administrador",
    "email": "alberto@teste.com",
    "password": "teste1234",
    "password_confirmation": "teste1234"
}
```

e será obtido como resposta:

```json
{
    "message": "Usuário cadastrado com sucesso!",
    "user": {
        "nome": "Administrador",
        "email": "alberto@teste.com",
        "updated_at": "2023-02-21T00:18:38.000000Z",
        "created_at": "2023-02-21T00:18:38.000000Z",
        "id": 1
    },
    "token": "1|Q8pzI7c0oxAVdKRp9yUt4RuhjVbWpLeB8NQCoNqI" //basta adicioná-lo no cabeçalho de toda requisição que necessite de autenticação
}
```
Para fazer login deste usuário, basta enviar o e-mail e senha via POST para a rota /api/login:

```json
{
    "email": "alberto@teste.com",
    "password": "teste1234",    
}
```
E será retornado o TOKEN deste usuário como resposta:

```json
{
    "message": "Usuário Autenticado com sucesso",
    "token": "2|iuls9SQIBvIMAn7iFfMdLK7HOfcGayDNs0z43kCn"
}
```

