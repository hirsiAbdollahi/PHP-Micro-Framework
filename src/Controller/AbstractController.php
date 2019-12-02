<?php


namespace Hash\Controller;


use Psr\Http\Message\ResponseInterface as Response;
use Slim\Psr7\Factory\StreamFactory;
use Twig\Environment;

/**
 * Méthodes utiles aux controlleurs
 */
abstract class AbstractController
{
    /**
     * Afficher un template Twig
     *
     * @param Environment $twig     Le service Twig
     * @param Response $response    La réponse HTTP (à retourner)
     * @param string $template      Le fichier Twig à interpréter
     * @param array $vars           Les variables utilisées dans le template
     *
     * @return Response             La réponse à renvoyer pour Slim
     */
    protected function template(Environment $twig, Response $response, string $template, array $vars = []) : Response
    {
        // Rendu du template Twig
        $contenu = $twig->render($template, $vars);

        // Création du flux (Stream [PSR-7]) pour le corps de la réponse
        $streamFactory = new StreamFactory();
        $stream = $streamFactory->createStream($contenu);

        // Renvoi de la réponse
        return $response->withBody($stream);
    }
}