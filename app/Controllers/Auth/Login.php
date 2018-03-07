<?php
namespace App\Controllers\Auth;

use App\Validator\Validator;
use Respect\Validation\Validator as v;

use App\Models\User;
use App\Models\Inbox;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Slim\Views\Twig;
use Slim\Flash\Messages;
use Slim\Router;

class Login {
    public function show(Request $request, Response $response, Twig $view) {
        return $view->render($response, 'auth/login.twig');
    }

    public function login(Request $request, Response $response, Twig $view, User $user, Messages $message, Router $router, Validator $validation) {
        extract($request->getParams());

        $valid = $validation->validate($request, [
            'email' => v::noWhitespace()->notEmpty(),
            'password' => v::noWhitespace()->notEmpty()->length(6, 14)
        ]);

        if($valid->failed()) return $response->withRedirect($router->pathFor('login'));

        $success = false;
        $errors = [];

        $login = $user
            ->where('username', '=', $email)
            ->where('password', '=', hash('sha512', $password . $email))
            ->get();

        if($login->count() == 0) {
            $errors[] = 'Invalid credentials.';
        } else {
            $success = true;

            $expiration = time() + ((isset($remember)) ? 604800 : 86400);

            setcookie('user', $login->first()->id, $expiration, '/', null, null, true);
            // TODO: check for activated
            $message->addMessage('success', 'Welcome back, ' . $login->first()->username . '!');
        }

        return $view->render($response, 'auth/login.twig', [
            'success' => $success,
            'cErrors' => $errors
        ]);
    }

    public function logout(Request $request, Response $response, Messages $message, Router $router) {
        setcookie('user', '', time()-31536000, '/', null, null, true);

        $message->addMessage('success', 'You have been successfully logged out!');
        return $response->withRedirect($router->pathFor('home'));
    }
}
