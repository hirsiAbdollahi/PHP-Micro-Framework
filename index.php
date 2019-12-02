<?php

// Instructions use
use Hash\Controller\AuthController;
use Hash\Controller\HomeController;
use Hash\Controller\PostController;
use Hash\Controller\SocialNetworkController;
use Hash\Middleware\UserAccessMiddleware;
use Slim\Routing\RouteCollectorProxy;


// Configuration (bootstraping de l'application)
require_once __DIR__ . '/config/bootstrap.php';





// Routes

// Page d'accueil
$app->get('/', [HomeController::class, 'homepage'])
    ->setName('homepage');

// Connexion
$app->map(['GET', 'POST'], '/login', [AuthController::class, 'login'])
    ->setName('login');

// Déconnexion
$app->get('/logout', [AuthController::class, 'logout'])
    ->setName('logout');

// Inscription
$app->map(['GET', 'POST'], '/register', [AuthController::class, 'register'])
    ->setName('register');


// Groupe: réseau social
$app->group('', function (RouteCollectorProxy $group) {
    // Fil d'actualité
    $group->get('/feed', [SocialNetworkController::class, 'feed'])
        ->setName('feed');

    // Profil d'utilisateur
    $group->map(['GET', 'POST'], '/profile', [SocialNetworkController::class, 'profile'])
        ->setName('profile');



    // CRUD des posts
    $group->group('/post', function (RouteCollectorProxy $group) {
        // Lire un post
        $group->get('/{id:[0-9]+}', [PostController::class, 'postRead'])
            ->setName('post-read');

        // Créer un post
        $group->map(['GET', 'POST'], '/new', [PostController::class, 'postAdd'])
            ->setName('post-add');

        // Modifier un post
        $group->map(['GET', 'POST'], '/{id:[0-9]+}/edit', [PostController::class, 'postEdit'])
            ->setName('post-edit');
    });
})->addMiddleware(new UserAccessMiddleware());





// Démarrage de l'application
$app->run();






