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

use App\Helpers\Pagination;

use Upload\File;

class Meme {
    protected $user;

    public function __construct() {
        if(isset($_COOKIE['user'])) {
            $this->user = User::find($_COOKIE['user']);
        }
    }

    public function getComments($id, Request $request, Response $response, Twig $view) {
        return $view->render($response, 'comments.twig', [
            'comments' => Comment::where('post_id', '=', $id)->limit(5)->orderBy('id', 'DESC')->get()
        ]);
    }

    public function getMeme($id, Request $request, Response $response, Twig $view) {
        $query = Comment::where('post_id', '=', $id);

        $paginate = Pagination::paginate($request, $query);
        extract($paginate);

        return $view->render($response, 'meme/meme.twig', [
            'meme' => M::where('id', '=', $id)->first(),
            'pagination' => $paginate,
            'comments' => $query->orderBy('id', 'DESC')->limit($limit)->skip($skip)->get()
        ]);
    }

    public function getFront(Request $request, Response $response, Twig $view) {
        $query = M::orderBy('points', 'DESC')->orderBy('date', explode(" ", date('Y-m-d h:i:s'))[0]);

        $paginate = Pagination::paginate($request, $query);
        extract($paginate);

        return $view->render($response, 'home.twig', [
            'memes' => $query->limit($limit)->skip($skip)->get(),
            'pagination' => $paginate
        ]);
    }

    public function getFresh(Request $request, Response $response, Twig $view) {
        $query = M::orderBy('id', 'DESC');

        $paginate = Pagination::paginate($request, $query);
        extract($paginate);

        return $view->render($response, 'home.twig', [
            'memes' => $query->limit($limit)->skip($skip)->get(),
            'pagination' => $paginate
        ]);
    }

    public function getRising(Request $request, Response $response, Twig $view) {
        $query = M::orderBy('points', 'DESC');

        $paginate = Pagination::paginate($request, $query);
        extract($paginate);

        return $view->render($response, 'home.twig', [
            'memes' => $query->limit($limit)->skip($skip)->get(),
            'pagination' => $paginate
        ]);
    }

    public function delete($id, Request $request, Response $response, Router $router, Messages $message) {
        $meme = M::where('author', '=', $this->user->username)->where('id', '=', $id);

        if($meme->count()) {
            $meme = $meme->first();

            if(unlink('C:\\xampp\htdocs\\public\\images\\' . $meme->image)) {
                $destroy = M::destroy($id);

                if($destroy) {
                    $message->addMessage('success', 'You have deleted your meme.');
                    return $response->withRedirect($router->pathFor('home'));
                }
            }
        } else {
            $message->addMessage('error', 'The meme could either not be found or is not yours.');
            return $response->withRedirect($router->pathFor('home'));
        }
    }

    public function edit($id, Request $request, Response $response, Twig $view, Validator $validation, Router $router, Messages $message) {
        $meme = M::where('author', '=', $this->user->username)->where('id', '=', $id);

        if(!$meme->count()) {
            $message->addMessage('error', 'You cannot edit others posts.');
            return $response->withRedirect($router->pathFor('home'));
        }

        return $view->render($response, 'edit.twig', [
            'meme' => $meme->first()
        ]);
    }

    public function postEdit($id, Request $request, Response $response, Validator $validation, Router $router, File $file, Twig $view, Messages $message) {
        extract($request->getParams());

        $uploaded = false;

        $file->setName(uniqid());

        $file->addValidations([
            new \Upload\Validation\Mimetype(array('image/png', 'image/jpeg', 'image/gif')),
            new \Upload\Validation\Size('5M')
        ]);

        $data = [
            'name'       => $file->getNameWithExtension(),
            'extension'  => $file->getExtension(),
            'mime'       => $file->getMimetype(),
            'size'       => $file->getSize(),
            'md5'        => $file->getMd5(),
            'dimensions' => $file->getDimensions()
        ];

        $valid = $validation->validate($request, [
            'caption' => v::notEmpty()->length(0, 35)
        ]);

        if(!empty($data['extension'])) {
            try {
                $file->upload();

                $uploaded = true;
            } catch(\Exception $e) {
                foreach($file->getErrors() as $error) {
                    $_SESSION['errors']['image'][] = $error;
                }
            }
        }

        if($valid->failed() || isset($_SESSION['errors']['image'])) return $response->withRedirect($router->pathFor('meme.edit', ['id' => $id]));

        if($this->user->isBanned()) {
            $message->addMessage('error', 'You are banned');
            return $response->withRedirect($router->pathFor('home'));
        }

        $meme = M::where('author', '=', $this->user->username)->where('id', '=', $id)->first();

        if(!empty($data['extension'])) {
            if(unlink('C:\\xampp\htdocs\\public\\images\\' . $meme->image)) {
                $meme->title = $caption;
                $meme->image = $data['name'];
                $meme->save();

                $message->addMessage('success', 'You have edited your meme');
                return $response->withRedirect($router->pathFor('meme', ['id' => $id]));
            }
        } else {
            $meme->title = $caption;
            $meme->save();

            $message->addMessage('success', 'You have edited your meme');
            return $response->withRedirect($router->pathFor('meme', ['id' => $id]));
        }

        return null;
    }

    public function comment($id, Request $request, Response $response, Twig $view, Validator $validation, Router $router) {
        extract($request->getParams());

        $valid = $validation->validate($request, [
            'comment' => v::notEmpty()->length(0, 120)
        ]);

        if($valid->failed()) return $response->withRedirect($router->pathFor('meme', ['id' => $id]));

        if($this->user->isBanned()) return $response->withRedirect($router->pathFor('meme', ['id' => $id]));

        Comment::create([
            'post_id' => $id,
            'author' => $this->user->username,
            'date' => date('Y-m-d h:i:s'),
            'comment' => nl2br($comment),
            'avatar' => $this->user->avatar
        ]);

        $this->user->post_count += 1;
        $this->user->save();

        return $response->withRedirect($router->pathFor('meme', ['id' => $id]));
    }
}
