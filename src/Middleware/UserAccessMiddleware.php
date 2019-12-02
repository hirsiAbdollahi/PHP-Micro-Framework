<?php


namespace Hash\Middleware;


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as Handler;

class UserAccessMiddleware implements MiddlewareInterface
{
    public function process(Request $request, Handler $handler): ResponseInterface
    {
        $response = $handler->handle($request);

        // TODO: vérifier le statut de l'utilisateur
        return $response->withStatus(403, 'Forbidden');
    }
}