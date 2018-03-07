<?php
namespace App\Controllers\User;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Slim\Views\Twig;
use App\Models\User;
use Upload\File;

use Slim\Router;

class Avatar {
    public function show(Request $request, Response $response, Twig $view) {
        return $view->render($response, 'user/avatar.twig');
    }

    public function change(Request $request, Response $response, Twig $view, File $file, Router $router) {
        $file->storage = new \Upload\Storage\FileSystem('C:\xampp\htdocs\public\images\avatars');
        
        $user = User::find($_COOKIE['user']);
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

        try {
            $file->upload();
            $uploaded = true;

            $user->avatar = $data['name'];
            $user->save();

        } catch(\Exception $e) {
            foreach($file->getErrors() as $error) {
                $_SESSION['errors']['image'][] = $error;
                $uploaded = false;
            }

            return $response->withRedirect($router->pathFor('avatar'));
        }

        return $view->render($response, 'user/avatar.twig', [
            'uploaded' => $uploaded,
            'name' => $data['name']
        ]);
    }
}
