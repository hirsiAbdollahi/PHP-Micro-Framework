<?php

// Instructions use
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Handlers\Strategies\RequestResponseArgs;
use Slim\Routing\RouteCollectorProxy;


// Autoloader de Composer
require __DIR__ . '/vendor/autoload.php';





// Instanciation de l'application Slim
$app = AppFactory::create();
$app->setBasePath('/slim');
// Stratégie des paramètres dynamiques
$app->getRouteCollector()
    ->setDefaultInvocationStrategy(new RequestResponseArgs());





// Routes
$app->get('/', function (Request $request, Response $response) {
    $response->getBody()->write('Hello de Slim v4 !');
    return $response;
})->setName('homepage');

$app->get('/feed/{category}/{filter}', function (Request $request, Response $response, $category, $filter) {
    $response->getBody()->write(sprintf(
        'Catégorie: %s<br>Filtre: %s',
        $category,
        $filter
    ));
    return $response;
});



// Groupe de routes
$app->group('/user', function (RouteCollectorProxy $group) {
    // /user    page profil
    $group->get('', function (Request $request, Response $response) {
        $response->getBody()->write('Votre profil');
        return $response;
    });

    // /user/list   liste des utilisateurs
    $group->get('/list', function (Request $request, Response $response) {
        $response->getBody()->write('Liste des users');
        return $response;
    });

    // /user/42     profil d'un utilisateur
    $group->get('/{id:[0-9]+}', function (Request $request, Response $response, $id) {
        $response->getBody()->write('Utilisateur n°' . $id);
        return $response;
    });
});




// Démarrage de l'application
$app->run();






