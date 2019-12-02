<?php


namespace Hash\Service;


class FlashMessage
{
    /**
     * Enregistrer un message flash en session
     * @param string $type      ex: success, info, ...
     * @param string $message   le contenu du message
     * @return void (ne retourne pas)
     */
    public function add(string $type, string $message) : void
    {
        // Représentation de 1 message sous forme de tableau
        $flash = [
            'type' => $type,
            'message' => $message,
        ];

        // Enregistrement d'un message dans une clé "flash" de la session
        // Insérer un élément dans un tableau:
        //      $tableau[] = $valeur
        $_SESSION['flash'][] = $flash;
    }
}