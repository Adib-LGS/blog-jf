<?php
/**
 * Cette Page va servir a faire des 
 * Test Unitaires
 */
namespace Test\Framework;

use Framework\App;
use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;

class AppTest extends TestCase{

    /** Cas pr Test les "/" a la fin de l'uri */
    public function testRedirectTrailingSlash(){
        //On lance la methode run() de App
        $app = new App();
        $request = new ServerRequest('GET', '/demolash/');
        $response = $app->run($request);
        //le requete recoit la réponse et on vérifie la Reception du code 301 Tout nous est renvoyer ds un array
        $this->assertContains('/demolash', $response->getHeader('Location'));
        $this->assertEquals(301, $response->getStatusCode());
    }
    
    /**Cas pour tester les réponses uri du Blog */
    public function testBlog(){
        $app = new App();
        $request = new ServerRequest('GET', '/blog');
        $response = $app->run($request);
        $this->assertContains('<h1>Bienvenu sur mon Blog</h1>', (string)$response->getBody());
        $this->assertEquals(200, $response->getStatusCode());
    }
    
     /**Cas pour tester les réponses uri du Blog */
     public function testError404(){
        $app = new App();
        $request = new ServerRequest('GET', '/qwerty');
        $response = $app->run($request);
        $this->assertContains('<h1>Error 404</h1>', (string)$response->getBody());
        $this->assertEquals(404, $response->getStatusCode());
    }
}