<?php
namespace App\Middleware;

use Slim\Views\Twig;

class UserAuth {
    protected $view;

    public function __construct(Twig $view) {
        $this->view = $view;
    }

    public function __invoke($request, $response, $next) {
        $this->view->getEnvironment()->addGlobal('user', isset($_COOKIE['user']) ? $_COOKIE['user'] : null);

        $response = $next($request, $response);
        return $response;
    }
}