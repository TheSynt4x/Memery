<?php
namespace App\Middleware;

use App\Models\User;

use Slim\Router;
use Slim\Flash\Messages;

class Admin {
    protected $router, $message;

    public function __construct(Router $router, Messages $message) {
        $this->router = $router;
        $this->message = $message;
    }

    public function __invoke($request, $response, $next) {
        if (isset($_COOKIE['user'])) {
            $user = User::find($_COOKIE['user']);

            if(!$user->isAdmin()) {
                $this->message->addMessage('error', 'Administrative rights required.');

                return $response->withRedirect($this->router->pathFor('home'));
            }
        } else {
            $this->message->addMessage('success', 'Please sign in before doing that.');

            return $response->withRedirect($this->router->pathFor('home'));
        }

        $response = $next($request, $response);
        return $response;
    }
}
