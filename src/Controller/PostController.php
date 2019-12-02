<?php


namespace Hash\Controller;


use Psr\Http\Message\ResponseInterface as Response;

/**
 * CRUD des posts
 */
class PostController extends AbstractController
{
    /**
     * Lire/voir un post
     */
    public function postRead($id, Response $response)
    {
        $response->getBody()->write('Post ' . $id);
        return $response;
    }

    /**
     * Créer un post
     */
    public function postAdd(Response $response)
    {
        $response->getBody()->write('Ajouter un post');
        return $response;
    }

    /**
     * Modifier un post
     */
    public function postEdit(Response $response, $id)
    {
        $response->getBody()->write('Modifier le post ' . $id);
        return $response;
    }
}