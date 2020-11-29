<?php
namespace App\Controllers;

use App\DataBase\MySql\MySql;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\PhpRenderer;

class Auth
{
    /**
     * @var PhpRenderer
     */
    protected $view;
    /**
     * @var MySql
     */
    protected $db;

    public function __construct(PhpRenderer $view, MySql $db) {
        $this->view = $view;
        $this->db = $db;
    }

    public function register(Request $request, Response $response, $args = [])
    {
        if ($request->getMethod() === 'GET') {
            return $this->view->render($response, 'auth/register.phtml');
        }
        //todo validation
        $password = $request->getParsedBody()['password'];
        $email = $request->getParsedBody()['email'];
        $this->db->save('users', ['email' => $email, 'password' => md5($password, true)]);
        #var_dump($request->getParsedBody());
        return $this->view->render($response, 'auth/register.phtml');
    }
}