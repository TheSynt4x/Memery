<?php
namespace App\Middleware;

use Slim\Router;
use Slim\Flash\Messages;

class Auth {
    protected $router, $message;

    public function __construct(Router $router, Messages $message) {
        $this->router = $router;
        $this->message = $message;
    }

    public function __invoke($request, $response, $next) {
        if (!isset($_COOKIE['user'])) {
            $this->message->addMessage('success', 'Please sign in before doing that.');

            return $response->withRedirect($this->router->pathFor('home'));
        }

        $response = $next($request, $response);
        return $response;
    }
}