<?php
/**
 * Ce fichier va etre utilisée pour rediriger toutes les pages
 */

use GuzzleHttp\Psr7\ServerRequest;
use Psr\Http\Message\ServerRequestInterface;

require '../vendor/autoload.php';

$app = new \Framework\App();
//La requete va etre generer Automatiquement grace a Guzzle Library
$reponse = $app->run(\GuzzleHttp\Psr7\ServerRequest::fromGlobals());

//Utilisation de http-interop/response-sender pr envoyer les réponse
\Http\Response\send($reponse);