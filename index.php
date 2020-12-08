<?php
use Slim\Factory\AppFactory;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

include_once('LivrosController.php');

require __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();

// $app->post('/api/usuarios', "UsuarioController:inserir");

$app->group('/api/livros', function($app){

    $app->get('', 'LivrosController:listar');
    $app->post('', 'LivrosController:inserir');
    $app->get('/{id}', 'LivrosController:buscarPorId');    
    $app->put('/{id}', 'LivrosController:atualizar');
    $app->delete('/{id}', 'LivrosController:deletar');
});
// ->add('UsuarioController:validarToken');

// $app->post('/api/login', "UsuarioController:autenticar");

$app->run();

?>