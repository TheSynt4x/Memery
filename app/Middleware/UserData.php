<?php
namespace App\Middleware;

use Slim\Views\Twig;

use App\Models\User;
use App\Models\Inbox;


class UserData {
    protected $view;

    public function __construct(Twig $view) {
        $this->view = $view;
    }

    public function __invoke($request, $response, $next) {
        if (isset($_COOKIE['user'])) {
            $user = User::find($_COOKIE['user']);
            $this->view->getEnvironment()->addGlobal('userdata', $user);

            $to = Inbox::where('to_user', '=', $user->username)->where('seen', '=', 0);
            $this->view->getEnvironment()->addGlobal('count', $to->count());
        }

        $response = $next($request, $response);
        return $response;
    }
}
