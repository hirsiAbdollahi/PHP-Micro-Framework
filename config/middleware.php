<?php

use Hash\Middleware\HttpForbiddenMiddleware;

// Activer la gestion des erreurs PHP par Slim
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);

// Ajout du Middleware pour les pages 403 (accès interdit)
$app->addMiddleware(new HttpForbiddenMiddleware($app));