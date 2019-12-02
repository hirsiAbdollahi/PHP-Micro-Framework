<?php


namespace Hash\Middleware;


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as Handler;
use Slim\Psr7\Response;

class HeaderMiddleware implements MiddlewareInterface
{
    /**
     * Process an incoming server request.
     *
     * Processes an incoming server request in order to produce a response.
     * If unable to produce the response itself, it may delegate to the provided
     * request handler to do so.
     */
    public function process(Request $request, Handler $handler): ResponseInterface
    {
        // Récupération du contenu de la réponse
        $response = $handler->handle($request);
        $content = $response->getBody();

        // Création de la réponse modifiée
        $response = new Response();
        $response->getBody()->write('Voici votre page:<hr>' . $content);

        return $response;
    }
}