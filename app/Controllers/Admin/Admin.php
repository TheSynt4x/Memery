<?php
namespace App\Controllers\Admin;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Models\User;
use App\Models\Meme;
use App\Models\Inbox;

use Slim\Flash\Messages;
use Slim\Router;

class Admin
{
    public function __construct()
    {
        $this->user = User::find($_COOKIE['user']);
    }

    public function delete($id, Request $request, Response $response, Router $router, Messages $message) {
        $meme = Meme::find($id);

        if($meme) {
            $destroy = Meme::destroy($id);

            if($destroy) {
                $message->addMessage('success', 'You have deleted that meme.');
                return $response->withRedirect($router->pathFor('home'));
            }
        } else {
            $message->addMessage('error', 'The meme could not be found.');
            return $response->withRedirect($router->pathFor('home'));
        }

        return null;
    }

    public function ban($username, Request $request, Response $response, Router $router, Messages $message)
    {
        $user = User::where('username', '=', $username);

        if(!$user->count()) {
            $message->addMessage('error', 'User '.$username.' was not found.');
            return $response->withRedirect($router->pathFor('home'));
        }

        $user = $user->first();

        if(!$user->isBanned()) {
            if (!$user->isAdmin()) {
                $user->ban = 1;
                $user->save();

                Inbox::create([
                    'from_user' => $this->user->username,
                    'to_user'   => $username,
                    'subject'   => 'Regarding your misbehavior',
                    'message'   => 'You have been violating the terms of service on this website and therefore the administrative team has made a decision to permanently ban your account. If you think this is a mistake, you can write your complaint to the user "admin". Thank you for stay and enjoy the website.',
                    'date' => date('Y-m-d')
                ]);

                $message->addMessage('success', 'You have banned ' . $username);
                return $response->withRedirect($router->pathFor('home'));
            } else {
                $message->addMessage('error', 'You cannot ban other admins.');
                return $response->withRedirect($router->pathFor('home'));
            }
        } else {
            $user->ban = 0;
            $user->save();

            $message->addMessage('success', 'You have unbanned ' . $username);
            return $response->withRedirect($router->pathFor('home'));
        }

        return null;
    }

    public function warn($username, Request $request, Response $response, Router $router, Messages $message)
    {
        Inbox::create([
            'from_user' => $this->user->username,
            'to_user'   => $username,
            'subject'   => 'Regarding your misbehavior',
            'message'   => 'You have been violating the terms of service on this website and therefore the administrative team has made a decision to warn you. If you think this is a mistake, you can write your complaint to the user "admin". Thank you for stay and enjoy the website.',
            'date' => date('Y-m-d')
        ]);

        $message->addMessage('success', 'You have warned the user: ' . $username);
        return $response->withRedirect($router->pathFor('home'));
    }
}
