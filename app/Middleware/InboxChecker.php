<?php
namespace App\Middleware;

use Slim\Router;
use Slim\Flash\Messages;

use App\Models\User;
use App\Models\Inbox;

use Slim\Views\Twig;

class InboxChecker {
    protected $router, $message;

    public function __construct(Twig $view, Router $router, Messages $message) {
        $this->view = $view;
        $this->router = $router;
        $this->message = $message;
    }

    public function __invoke($request, $response, $next) {
        if (isset($_COOKIE['user'])) {
            $user = User::find($_COOKIE['user']);
            $to = Inbox::where('to_user', '=', $user->username)->where('seen', '=', 0);
            if($to->count() > 0) {
                $this->view->getEnvironment()->addGlobal('inboxmsg', 'You have '. $to->count() . ' unread messages!');
            }
        }

        $response = $next($request, $response);
        return $response;
    }
}
