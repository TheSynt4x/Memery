<?php
namespace App\Controllers\Home;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Slim\Views\Twig;

use App\Models\Meme;
use App\Models\User;

use App\Validator\Validator;
use Respect\Validation\Validator as v;

use Slim\Router;

use Upload\File;

class Upload {
    public function show(Request $request, Response $response, Twig $view) {
        return $view->render($response, 'upload.twig');
    }

    public function upload(Request $request, Response $response, Twig $view, Validator $validation, Router $router, File $file) {
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
            'caption' => v::length(0, 35)
        ]);

        try {
            $file->upload();
        } catch(\Exception $e) {
            foreach($file->getErrors() as $error) {
                $_SESSION['errors']['image'][] = $error;
                $uploaded = false;
            }
        }

        if($valid->failed() || isset($_SESSION['errors']['image'])) {
            $uploaded = false;
            return $response->withRedirect($router->pathFor('upload'));
        }

        $user = User::find($_COOKIE['user']);

        if($user->isBanned()) return $response->withRedirect($router->pathFor('meme', ['id' => $id]));

        Meme::create([
            'title' => $caption,
            'author' => $user->username,
            'image' => $data['name'],
            'date' => date('Y-m-d h:i:s'),
            'points' => 0
        ]);

        $user->post_count += 1;
        $user->save();

        $uploaded = true;

        return $view->render($response, 'upload.twig', [
            'uploaded' => $uploaded
        ]);
    }
}
