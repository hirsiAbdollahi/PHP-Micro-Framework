<?php


namespace Hash\Controller;


use Medoo\Medoo;
use Psr\Http\Message\ResponseInterface as Response;
use Twig\Environment as Twig;

class HomeController extends AbstractController
{
    /**
     * Page d'accueil
     */
    public function homepage(Response $response, Twig $twig, Medoo $orm)
    {
        $users = $orm->select('user', [
            "id",
            "username"
        ]);
        return $this->template($twig, $response, 'index.html.twig', [
            'test' => 'Coucou',
            'utilisateurs' => $users
        ]);
    }
}