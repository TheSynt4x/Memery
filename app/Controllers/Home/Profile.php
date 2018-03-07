<?php
namespace App\Controllers\Home;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Slim\Views\Twig;

use App\Models\Comment;
use App\Models\User;
use App\Models\Meme as M;

use App\Validator\Validator;
use Respect\Validation\Validator as v;

use Slim\Router;
use Slim\Flash\Messages;

class Profile {
    public function getProfile($name, Request $request, Response $response, Twig $view, Router $router, Messages $message) {
        $user = User::where('username', '=', $name)->first();
        
        if($user == null) {
            $message->addMessage('error', 'The user '. $name .' does not exist.');
            return $response->withRedirect($router->pathFor('home'));
        }

        return $view->render($response, 'user/profile.twig', [
            'user' => $user
        ]);
    }

}