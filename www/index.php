<?php
 
namespace Phpcrud;



require ('vendor/autoload.php');
require ('database.php');

include('routes.php');
require('app/controllers/HomeController.php');
require('app/controllers/DevedorController.php');
require('app/controllers/DividaController.php');
 
$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['REQUEST_URI'] ?? '/';
 
$router = new Router($method,$path);
 
#Dashboard
$router->get('', 'App\Controllers\DevedorController::dashboard'); 
$router->get('/', 'App\Controllers\DevedorController::dashboard');
$router->get('/dashboard', 'App\Controllers\DevedorController::dashboard');

#Devedor
$router->get('/devedores', 'App\Controllers\DevedorController::listDevedores');
$router->get('/devedor/{id}', 'App\Controllers\DevedorController::get','{id}');
$router->post('/devedores', 'App\Controllers\DevedorController::insert','{devedor}');
$router->update('/devedor/{id}', 'App\Controllers\DevedorController::update','{devedor}');
$router->delete('/devedor/{id}', 'App\Controllers\DevedorController::delete','{id}');

#Dívidas
$router->get('/dividas', 'App\Controllers\DividaController::listDividas');
$router->delete('/divida/{id}', 'App\Controllers\DividaController::delete','{id}');
$router->post('/dividas', 'App\Controllers\DividaController::insert','{divida}');
$router->update('/divida/{id}', 'App\Controllers\DividaController::update','{divida}');
$router->get('/migrate', 'App\Controllers\HomeController::migrate');
$router->get('/populate', 'App\Controllers\HomeController::populate');
$router->get('/start', 'App\Controllers\HomeController::start');

 
$result = $router->handler();

if (!$result) {
    http_response_code(404);
    
    include('views/404.php');
    die();
}



// verifico se é uma função anônima
if ($result instanceof Closure) {
    // imprimo a página atual
    echo $result($router->getParams());

// se não for uma função anônima e for uma string
} elseif (is_string($result)) {
    // eu quebro a string nos dois-pontos, dois::pontos
    // transformando em array
    $result = explode('::', $result);

    // instancio o controller
    $controller = new $result[0];
    // guardo o método a ser executado (em um controller ele se chama action)
    $action = $result[1];
 
    // finalmente executo o método da classe
    echo $controller->$action($router->getParams());
}

 