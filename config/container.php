<?php

use function DI\factory;
use Medoo\Medoo;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;


// Récupération du conteneur de services de l'application
$container = $app->getContainer();


// Configuration d'un service Twig
$container->set(Environment::class, factory(function () use ($app) {
    $loader = new FilesystemLoader(__DIR__ . '/../templates');
    $twig = new Environment($loader, [
        'debug' => true
    ]);

    // Création d'une fonction Twig pour créer des liens
    $uriFunc = new TwigFunction(
        'urlFor',
        [$app->getRouteCollector()->getRouteParser(), 'urlFor']
    );
    $twig->addFunction($uriFunc);

    // Fonction Twig pour récupérer les messages flash depuis la session
    $flashFunc = new TwigFunction('getFlashes', function () {
        // Récupération des messages flashs
        // Opérateur null coalescent: ??
        //      Retourner la 1e valeur définie et non nulle
        $messages = $_SESSION['flash'] ?? [];

        // Suppression de la clé "flash" dans la session
        unset($_SESSION['flash']);

        // Retourner les messages
        return $messages;
    });
    $twig->addFunction($flashFunc);

    return $twig;
}));



// Medoo pour communiquer avec la base de données
$container->set(Medoo::class, factory(function () {
    $medoo = new Medoo([
        'database_type' => 'mysql',
        'database_name' => 'hash',
        'server' => 'localhost',
        'username' => 'root',
        'password' => ''
    ]);
    return $medoo;
}));









