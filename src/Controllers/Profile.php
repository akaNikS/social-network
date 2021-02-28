<?php
namespace App\Controllers;

use App\DataBase\MySql\MySql;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Response;
use Slim\Views\PhpRenderer;

class Profile
{
    public function __construct(PhpRenderer $view, MySql $db)
    {
        $this->view = $view;
        $this->db = $db;
    }

    public function profile(Response $response): ResponseInterface
    {
        $user = $this->db->getArrays('app_users', ['id' => $_SESSION['user_id'] ?? 0]);
        if (empty($user[0]['id'])) {
           return $response->withStatus(301)->withHeader('Location', 'auth');
        }

        return $this->view->render(
            $response,
            'private/private.phtml',
            [
                'name' => $user[0]['name'],
            ]
        );
    }
}