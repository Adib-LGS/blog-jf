<?php
/**
 * Utilise Library guzzlehttp/psr7
 * Pr eviter de gerer les method request et respons
 * Cette classe va representer l'application
 */

namespace Framework;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class App{

    public function run(ServerRequestInterface $request): ResponseInterface {
        //Récupere la requete puis l'uri pui le chemin
        $uri = $request->getUri()->getPath();
        //Verifier Slash a la fin de l'uri
        if(!empty($uri) && $uri[-1] === "/"){
            //On crée une réponse en utilisant l'implementation de Guzzle
            $response = new Response();
            $response = $response->withStatus(301);
            $response = $response->withHeader('Location', substr($uri, 0, -1));
            return $response;
        }
        if($uri === '/blog'){
            //le Constructeur de Response prend (Code res, array Header, body)
            return new Response(200, [], '<h1>Bienvenue chez Jean Forteroche</h1>');
        }
        //Récupere le contenue de la Réponse
        return  new Response(404, [], '<h1>Error 404</h1>');
    }
}
