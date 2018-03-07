<?php
namespace App\Controllers\User;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Slim\Views\Twig;
use App\Models\User;

use App\Validator\Validator;
use Respect\Validation\Validator as v;

use Slim\Router;

class Password {
    public function show(Request $request, Response $response, Twig $view) {
        return $view->render($response, 'user/password.twig');
    }

    public function change(Request $request, Response $response, Twig $view, Validator $validation, Router $router) {
        extract($request->getParams());

        $success = false;
        $errors = [];

        $valid = $validation->validate($request, [
            'current' => v::noWhitespace()->notEmpty()->length(6, 14),
            'new' => v::noWhitespace()->notEmpty()->length(6, 14),
            'confirm' => v::noWhitespace()->notEmpty()->length(6, 14)->MatchesPassword($new)
        ]);

        if($valid->failed()) return $response->withRedirect($router->pathFor('password'));

        $user = User::find($_COOKIE['user']);

        $current = hash('sha512', $current . $user->username);

        if($user->password == $current) {
            $user->password = hash('sha512', $new . $user->username);
            if($user->save()) $success = true;
        } else {
            $errors[] = 'Incorrect current password!';
        }

        return $view->render($response, 'user/password.twig', [
            'success' => $success,
            'cErrors' => $errors
        ]);
    }
}
