<?php
namespace App\Routing;

use App\Controllers\Auth;
use App\Controllers\Profile;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class Routing
{
    public static function init(\Slim\App $app): \Slim\App
    {
        $app->get('/', function (Request $req, Response $res, $args = []) {
            return $res->withStatus(400)->getBody()->write('Bad Request');
        });
        $app->get('/register', [Auth::class, 'register']);
        $app->post('/register', [Auth::class, 'register']);

        $app->get('/auth', [Auth::class, 'authorization']);
        $app->post('/auth', [Auth::class, 'authorization']);

        $app->get('/private', [Profile::class, 'profile']);

        return $app;
    }
}
