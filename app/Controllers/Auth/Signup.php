<?php
namespace App\Controllers\Auth;

use App\Models\User;

use App\Validator\Validator;
use Respect\Validation\Validator as v;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Slim\Views\Twig;
use Slim\Flash\Messages;
use Slim\Router;

class Signup {
    public function show(Request $request, Response $response, Twig $view) {
        return $view->render($response, 'auth/register.twig');
    }

    public function register(Request $request, Response $response, Validator $validation, Router $router, Twig $view) {
        extract($request->getParams());

        $success = false;

        $valid = $validation->validate($request, [
            'username' => v::alnum()->noWhitespace()->notEmpty()->length(4, 12)->UsernameAvailable()->Prohibit(),
            'email' => v::email()->noWhitespace()->notEmpty()->EmailAvailable(),
            'password' => v::noWhitespace()->notEmpty()->length(6, 14),
            'confirm' => v::noWhitespace()->notEmpty()->length(6, 14)->MatchesPassword($password)
        ]);

        if($valid->failed()) return $response->withRedirect($router->pathFor('register'));

        $success = true;

        $user = User::create([
            'username' => $username,
            'password' => hash('sha512', $password . $username),
            'email' => $email,
            'code' => rand(pow(10, 5-1), pow(10, 5)-1),
            'activated' => 0,
            'ban' => 0
        ]);

        // send email

        return $view->render($response, 'auth/register.twig', [
            'success' => $success
        ]);
    }
}
