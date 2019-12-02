<?php

use DI\Bridge\Slim\Bridge;

// Instanciation de l'application Slim par le "Bridge" de PHP-DI
$app = Bridge::create();

// Spécifier le répertoire racine de l'application Slim
$app->setBasePath('/slim');