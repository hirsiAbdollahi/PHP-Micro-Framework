<?php


namespace Hash\Controller;


use Psr\Http\Message\ResponseInterface as Response;
use Twig\Environment;

class AuthController extends AbstractController
{
    /**
     * Page de connexion
     */
    public function login(Response $response, Environment $twig)
    {
        return $this->template($twig, $response, 'auth/login.html.twig');
    }

    /**
     * Page de déconnexion
     */
    public function logout(Response $response)
    {
        $response->getBody()->write('Déconnexion');
        return $response;
    }

    /**
     * Page d'inscription
     */
    public function register(Response $response)
    {
        $response->getBody()->write('Inscription');
        return $response;
    }
}