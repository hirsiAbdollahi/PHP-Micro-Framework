<?php


namespace Hash\Controller;


use Psr\Http\Message\ResponseInterface as Response;

/**
 * Routes du réseau social
 */
class SocialNetworkController extends AbstractController
{
    /**
     * Fil d'actualités
     */
    public function feed(Response $response)
    {
        $response->getBody()->write('Feed');
        return $response;
    }

    /**
     * Page de profil
     */
    public function profile(Response $response)
    {
        $response->getBody()->write('Page profil');
        return $response;
    }
}