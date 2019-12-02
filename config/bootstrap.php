<?php

// Autoloader de Composer
require_once __DIR__ . '/../vendor/autoload.php';

// Démarrage de la session
session_start();



// Configuration de l'application Slim
require_once __DIR__ . '/app.php';

// Ajout des Middlewares
require_once __DIR__ . '/middleware.php';

// Configuration du conteneur de services (PHP-DI)
require_once __DIR__ . '/container.php';