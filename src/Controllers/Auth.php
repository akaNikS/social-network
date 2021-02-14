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
        $errors = [];
        if ($request->getMethod() === 'GET') {
            return $this->view->render($response, 'auth/register.phtml');
        }
        $password = $request->getParsedBody()['password'];
        $email = $request->getParsedBody()['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'invalid email';
        }
        if (strlen($password) < 8) {
            $errors['password'] = 'short';
        }
        if (empty($errors)) {
            $this->db->save('users', ['email' => $email, 'password' => md5($password, true)]);
        }
        // TODO success registration
        return $this->view->render($response, 'auth/register.phtml', ['errors' => $errors]);
    }
}