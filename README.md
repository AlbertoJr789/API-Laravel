<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>

# ModerniZ-API

[Documentação](https://docs.google.com/document/d/1PGPLBDSXh5zsPUWpLjjr4X3nKOksqdv6UXW-PI07PKk/edit)

-- Instruções

Criar model com a porra toda

    php artisan make:model <nome> --all

Criando Factory

    php artisan make:factory ProdutoFactory

Criando seeder

    php artisan make:seeder ProdutoSeeder

Dentro da classe da factory, utilizando funções do faker para criar dados fictícios

Rotas de API e Resources com Versionamento

Rotas:

método apiResource: providencia todas as rotas de api de padrão RESTful, 
GET, PUT, PATCH, UPDATE e DELETE. Não é então necessário implementar endpoint por endpoint, basta seguir as convenções.

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\V1'],function(){
    Route::apiResource('categorias',CategoriaController::class);
});


Criando Resources para transformar a resposta dos endpoints

    php artisan make:resource NomeResource

Filtros

cria pasta Filters em app, depois arquivo 'Nome'Query

Haverá uma classe base chamada 'Filter', que montará as condiçoes dentro da cláusula where do eloquent

Criando registros

No controller, será chamada a função store()

Será criado uma classe de requisição que tratará destas inserções

    php artisan make:request StoreProdutoRequest

