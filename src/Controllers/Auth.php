<?php
namespace App\Controllers;

use App\Adapters\ViewAdapter;
use App\Services\Crypto\Crypto;
use App\Services\User\UserService;
use App\Services\User\Validators\UserValidator;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Slim\Psr7\Message;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class Auth
{
    /**
     * @var ViewAdapter
     */
    protected $view;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var Crypto
     */
    protected $crypto;

    /**
     * @var UserValidator
     */
    protected $userValidator;

    /**
     * @var UserService
     */
    protected $user;

    public function __construct(ViewAdapter $view, LoggerInterface $logger, Crypto $crypto, UserValidator $userValidator, UserService $user) {
        $this->view = $view;
        $this->logger = $logger;
        $this->crypto = $crypto;
        $this->userValidator = $userValidator;
        $this->user = $user;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return ResponseInterface|Message|Response
     */
    public function register(Request $request, Response $response, $args = [])
    {
        if (isset($_SESSION['user_id'])) {
            return $response->withStatus(301)->withHeader('Location', 'private');
        }

        if ($request->getMethod() === 'GET') {
            return $this->view->render($response, 'auth/register.tpl');
        }

        $verifiedData = $this->invalidateForm($request->getParsedBody());
        $validateResult = $this->userValidator->validate($verifiedData, UserValidator::REG_CONTEXT);
        if (!$validateResult->isValid()) {
            $errors = $this->userValidator->adapter($validateResult->getFailures());
            return $this->view->render($response, 'auth/register.tpl', ['errors' => $errors]);
        }

        $this->user->saveUser(
            $verifiedData['email'],
            $this->crypto->preparedPassword($verifiedData['password']),
            $verifiedData['name'],
            $verifiedData['surname'],
            $verifiedData['middle_name']
        );

        $user = $this->user->getUserByEmail($verifiedData['email']);
        if ($user === null) {
            // todo something =)

            $errors['email'] = 'service unavailable';
            return $this->view->render($response, 'auth/register.tpl', ['errors' => $errors]);
        }

        $_SESSION['user_id'] = $user['id'];
        $this->logger->info('User ['. $verifiedData['email'] .'] successfully registered');
        return $response->withStatus(301)->withHeader('Location', 'private');
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return ResponseInterface
     */
    public function authorization(Request $request, Response $response, $args = []): ResponseInterface
    {
        if (isset($_SESSION['user_id'])) {
            return $response->withStatus(301)->withHeader('Location', 'private');
        }

        if ($request->getMethod() === 'GET') {
            return $this->view->render($response, 'auth/authorization.tpl');
        }

        $body = $request->getParsedBody();
        $validateResult = $this->userValidator->validate($body, UserValidator::AUTH_CONTEXT);
        if (!$validateResult->isValid()) {
            $errors = $this->userValidator->adapter($validateResult->getFailures());
            return $this->view->render($response, 'auth/authorization.tpl', ['errors' => $errors]);
        }

        $user = $this->user->getUserByEmail($body['email']);
        if ($user === null) {
            return $this->view->render($response, 'auth/authorization.tpl', ['errors' => ['email' => 'User not found']]);
        }
        if ($this->crypto->preparedPassword($body['password']) !== $user['password']) {
            return $this->view->render($response, 'auth/authorization.tpl', ['errors' => ['password' => 'Invalid password']]);
        }
        $_SESSION['user_id'] = $user['id'];
        // todo page private (template, controller, route)
        #header("Location: private");
        return $response->withStatus(301)->withHeader('Location', 'private');
    }

    /**
     * @param array $regFormData
     * @return array
     */
    private function invalidateForm(array $regFormData): array
    {
        $verifiedData['email'] = htmlspecialchars($regFormData['email'] ?? '');
        $verifiedData['password'] = htmlspecialchars($regFormData['password'] ?? '');
        $verifiedData['name'] = htmlspecialchars($regFormData['name'] ?? '');
        $verifiedData['surname'] = htmlspecialchars($regFormData['surname'] ?? '');
        $verifiedData['middle_name'] = htmlspecialchars($regFormData['middle_name'] ?? '');

        return $verifiedData;
    }
}