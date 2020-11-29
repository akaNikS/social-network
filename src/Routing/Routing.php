<?php
namespace App\Routing;

use App\Controllers\Auth;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class Routing
{
    public static function init(\Slim\App $app): \Slim\App
    {
        $app->get('/', function (Request $req, Response $res, $args = []) {
            return $res->withStatus(400)->write('Bad Request');
        });
        $app->get('/register', [Auth::class, 'register']);
        $app->post('/register', [Auth::class, 'register']);
        return $app;
    }
}
