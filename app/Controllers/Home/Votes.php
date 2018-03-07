<?php
namespace App\Controllers\Home;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Slim\Views\Twig;

use App\Models\Meme;
use App\Models\Votes as V;
use App\Models\User;

use Slim\Flash\Messages;

use Slim\Router;

class Votes {
    protected $user;

    public function __construct() {
        $this->user = User::find($_COOKIE['user']);
    }

    public function vote($type, $id, Request $request, Response $response, Router $router, V $v, Messages $message) {
        $meme = Meme::find($id);

        if($this->user->isBanned()) return $response->withRedirect($router->pathFor('home'));

        if(!$meme) return $response->withRedirect($router->pathFor('home'));

        switch(strtolower($type)) {
            case 'up':
                $votes = $v->where('post_id', '=', $meme->id)->where('voted_by', '=', $this->user->username)->get();

                if($votes->count()) {
                    $vote = $votes->first();

                    if($vote->upvote == 1) {
                        $message->addMessage('error', 'You have already upvoted this meme.');
                        return $response->withRedirect($router->pathFor('home'));
                    } else {
                        $vote->upvote = 1;
                        $vote->downvote = 0;
                        $vote->save();

                        $meme->points += 1;
                        $meme->save();

                        $message->addMessage('success', 'You have upvoted (2)');
                        return $response->withRedirect($router->pathFor('home'));
                    }
                } else {
                    $this->add($v, $meme->id, 1);

                    $meme->points += 1;
                    $meme->save();

                    $message->addMessage('success', 'You have upvoted (1)');
                    return $response->withRedirect($router->pathFor('home'));
                }
            break;
            case 'down':
                $votes = $v->where('post_id', '=', $meme->id)->where('voted_by', '=', $this->user->username)->get();

                if($votes->count()) {
                    $vote = $votes->first();

                    if($vote->downvote == 1) {
                        $message->addMessage('error', 'You have already downvoted this meme.');
                        return $response->withRedirect($router->pathFor('home'));
                    } else {
                        if($meme->points > 0) {
                            $vote->upvote = 0;
                            $vote->downvote = 1;
                            $vote->save();

                            $meme->points -= 1;
                            $meme->save();

                            $message->addMessage('success', 'You have downvoted (2)');
                            return $response->withRedirect($router->pathFor('home'));
                        }
                    }
                } else {
                    $this->add($v, $meme->id, 0, 1);

                    if($meme->points > 0) {
                      $meme->points -= 1;
                      $meme->save();
                    }

                    $message->addMessage('success', 'You have downvoted (1)');
                    return $response->withRedirect($router->pathFor('home'));
                }
            break;
        }
    }

    public function newVoting($type, $id, Request $request, Response $response, Router $router, V $v, Messages $message) {
        $meme = Meme::find($id);

        if($this->user->isBanned()) return;

        if(!$meme) return;

        switch(strtolower($type)) {
            case 'up':
                $votes = $v->where('post_id', '=', $meme->id)->where('voted_by', '=', $this->user->username)->get();

                if($votes->count()) {
                    $vote = $votes->first();

                    if($vote->upvote == 1) {
                        echo $meme->points;
                        exit;
                    } else {
                        $vote->upvote = 1;
                        $vote->downvote = 0;
                        $vote->save();

                        $meme->points += 1;
                        $meme->save();

                        echo $meme->points;
                        exit;
                    }
                } else {
                    $this->add($v, $meme->id, 1);

                    $meme->points += 1;
                    $meme->save();

                    echo $meme->points;
                    exit;
                }
            break;
            case 'down':
                $votes = $v->where('post_id', '=', $meme->id)->where('voted_by', '=', $this->user->username)->get();

                if($votes->count()) {
                    $vote = $votes->first();

                    if($vote->downvote == 1) {
                        echo 0;
                        exit;
                    } else {
                        $vote->upvote = 0;
                        $vote->downvote = 1;
                        $vote->save();

                        $meme->points -= 1;
                        $meme->save();

                        echo $meme->points;
                        exit;
                    }
                } else {
                    $this->add($v, $meme->id, 0, 1);

                      $meme->points -= 1;
                      $meme->save();


                    echo $meme->points;
                    exit;
                }
            break;
        }
    }

    private function add($v, $id, $up = 0, $down = 0)
    {
        $v->insert([
            'post_id' => $id,
            'voted_by' => $this->user->username,
            'upvote' => $up,
            'downvote' => $down
        ]);
    }
}
