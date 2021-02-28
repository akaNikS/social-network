<?php
namespace App\Controllers;

use App\DataBase\MySql\MySql;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
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

    /**
     * @var LoggerInterface
     */
    protected $logger;

    public function __construct(PhpRenderer $view, MySql $db, LoggerInterface $logger) {
        $this->view = $view;
        $this->db = $db;
        $this->logger = $logger;
    }

    public function register(Request $request, Response $response, $args = [])
    {
        // todo check auth
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
            // todo input user name
            $this->db->save('app_users', ['email' => $email, 'password' => md5($password, true), 'name' => '123']);
            $user = $this->db->getArrays('app_users', ['email' => $email]);
            if (empty($user[0]['id'])) {
                $errors['email'] = 'service unavailable';
            } else {
                $_SESSION['user_id'] = $user[0]['id'];
                $this->logger->info("User [$email] successfully registered");
                return $response->withStatus(301)->withHeader('Location', 'private');
            }
        }
        return $this->view->render($response, 'auth/register.phtml', ['errors' => $errors]);
    }

    public function authorization(Request $request, Response $response, $args = []): ResponseInterface
    {
        $errors = [];
        // TODO check auth
        if ($request->getMethod() === 'GET') {
            return $this->view->render($response, 'auth/authorization.phtml');
        }
        $password = $request->getParsedBody()['password'];
        $email = $request->getParsedBody()['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'invalid email';
        }
        if (strlen($password) < 8) {
            $errors['password'] = 'short';
        }
        if ($errors) {
            return $this->view->render($response, 'auth/authorization.phtml', ['errors' => $errors]);
        }
        $user = $this->db->getArrays('app_users', ['email' => $email])[0] ?? null;
        if ($user === null) {
            return $this->view->render($response, 'auth/authorization.phtml', ['errors' => ['email' => 'User not found']]);
        }
        if (md5($password, true) !== $user['password']) {
            return $this->view->render($response, 'auth/authorization.phtml', ['errors' => ['password' => 'Invalid password']]);
        }
        $_SESSION['user_id'] = $user['id'];
        // todo page private (template, controller, route)
        #header("Location: private");
        return $response->withStatus(301)->withHeader('Location', 'private');
    }
}