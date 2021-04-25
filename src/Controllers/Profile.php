<?php
namespace App\Controllers;

use App\Adapters\ViewAdapter;
use App\Services\User\UserService;
use Bitrix\Im\User;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Response;

class Profile
{
    /**
     * @var ViewAdapter
     */
    protected ViewAdapter $view;

    /**
     * @var UserService
     */
    protected UserService $user;

    public function __construct(ViewAdapter $view, UserService $user)
    {
        $this->view = $view;
        $this->user = $user;
    }

    /**
     * @param Response $response
     * @return ResponseInterface
     */
    public function profile(Response $response): ResponseInterface
    {
        $user = $this->user->getUserById($_SESSION['user_id']);
        if (empty($user['id'])) {
           return $response->withStatus(301)->withHeader('Location', 'auth');
        }

        return $this->view->render(
            $response,
            'private/private.tpl',
            [
                'name' => $user['name'],
                'fullName' => $user['surname'] . ' ' . $user['name'] . ' ' . $user['middle_name'] ?? '',
                'email' => $user['email']
            ]
        );
    }
}