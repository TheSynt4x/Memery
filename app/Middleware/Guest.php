<?php
namespace App\Middleware;

use Slim\Router;
use Slim\Flash\Messages;

class Guest {
    protected $container;

    public function __construct($container) {
        $this->container = $container;
    }

    public function __invoke($request, $response, $next) {
        if (isset($_COOKIE['user'])) {
            return $response->withRedirect($this->container->pathFor('home'));
        }

        $response = $next($request, $response);
        return $response;
    }
}