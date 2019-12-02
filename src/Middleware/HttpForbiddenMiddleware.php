<?php


namespace Hash\Middleware;


use Hash\Service\FlashMessage;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\App;
use Slim\Interfaces\RouteParserInterface;
use Slim\Psr7\Factory\StreamFactory;

class HttpForbiddenMiddleware implements MiddlewareInterface
{
    /** @var RouteParserInterface */
    private $routeParser;
    /** @var FlashMessage */
    private $flash;

    /**
     * Récupération de l'application Slim
     * afin de garder les services nécessaires en propriétés
     */
    public function __construct(App $slim)
    {
        // Pour pouvoir générer un lien vers la page de connexion
        $this->routeParser = $slim->getRouteCollector()->getRouteParser();
        // Pour créer un message d'erreur
        $this->flash = $slim->getContainer()->get(FlashMessage::class);
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $response = $handler->handle($request);

        // Vérification du code de statut HTTP
        if ($response->getStatusCode() === 403) {
            // Avertir l'utilisateur qu'il doit se connecter
            $this->flash->add('danger', 'Accès interdit: veuillez vous connecter.');
            session_write_close();

            // Rediriger vers la page de connexion
            $response = $response
                ->withStatus(302)
                ->withHeader(
                    'Location',
                    $this->routeParser->urlFor('login')
                );
        }

        return $response;
    }
}