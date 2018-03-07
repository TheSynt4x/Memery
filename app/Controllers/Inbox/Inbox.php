<?php
namespace App\Controllers\Inbox;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Validator\Validator;
use Respect\Validation\Validator as v;

use Slim\Views\Twig;

use App\Models\User;
use App\Models\Inbox as InboxModel;

use Slim\Router;
use Slim\Flash\Messages;

use App\Helpers\Pagination;

use Upload\File;

class Inbox {
    protected $user;

    public function __construct() {
        $this->user = User::find($_COOKIE['user']);
    }

    public function show(Request $request, Response $response, Twig $view, InboxModel $inbox) {
        $to = $inbox->where('to_user', '=', $this->user->username);

        Pagination::$limit = 10;

        $paginate = Pagination::paginate($request, $to);
        extract($paginate);

        if($page > $lastpage) return $response->withRedirect($router->pathFor('home'));

        $paginate['type'] = 1;

        return $view->render($response, 'inbox/inbox.twig', [
            'pagination' => $paginate,
            'messages' => $to->limit($limit)->skip($skip)->orderBy('id', 'DESC')->get()
        ]);
    }

    public function showCompose(Request $request, Response $response, Twig $view, InboxModel $inbox) {
        return $view->render($response, 'inbox/compose.twig');
    }

    public function showSent(Request $request, Response $response, Twig $view, InboxModel $inbox) {
        $from = $inbox->where('from_user', '=', $this->user->username);

        Pagination::$limit = 10;

        $paginate = Pagination::paginate($request, $from);
        extract($paginate);

        if($page > $lastpage) return $response->withRedirect($router->pathFor('home'));

        return $view->render($response, 'inbox/sent.twig', [
            'pagination' => $paginate,
            'from_messages' => $from->limit($limit)->skip($skip)->orderBy('id', 'DESC')->get()
        ]);
    }

    public function showReceived($id, Request $request, Response $response, Twig $view, InboxModel $inbox, Messages $message, Router $router) {
        $msg = $inbox->where('to_user', '=', $this->user->username)->where('id', '=', $id);

        if(!$msg->count()) {
            $message->addMessage('error', 'Message could not be found.');
            return $response->withRedirect($router->pathFor('inbox'));
        }

        $msg = $msg->first();
        $msg->seen = 1;
        $msg->save();

        return $view->render($response, 'inbox/view.twig', [
            'message' => $msg
        ]);
    }

    public function compose(Request $request, Response $response, Twig $view, InboxModel $inbox, Validator $validation, Router $router, Messages $message, File $file) {
        extract($request->getParams());

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
            'to' => v::notEmpty()->UserExists(),
            'subject' => v::notEmpty(),
            'body' => v::notEmpty()
        ]);

        if(!empty($data['extension'])) {
            try {
                $file->upload();

            } catch(\Exception $e) {
                foreach($file->getErrors() as $error) {
                    $_SESSION['errors']['image'][] = $error;
                }
            }
        }

        if($valid->failed() || isset($_SESSION['errors']['image'])) return $response->withRedirect($router->pathFor('inbox.compose'));

        $inbox->create([
            'from_user' => $this->user->username,
            'to_user' => $to,
            'subject' => $subject,
            'message' => $body,
            'image' => (!empty($data['extension'])) ? $data['name'] : '',
            'date' => date('Y-m-d')
        ]);

        $message->addMessage('success', 'Your message has been sent!');
        return $response->withRedirect($router->pathFor('inbox.compose'));
    }
}
