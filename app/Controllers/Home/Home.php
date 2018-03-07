<?php
namespace App\Controllers\Home;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Slim\Views\Twig;

use App\Models\Meme;

use Slim\Router;

use App\Helpers\Pagination;

class Home {
    public function index(Request $request, Response $response, Twig $view, Meme $meme, Router $router) {
        $count = $meme->all();

        $paginate = Pagination::paginate($request, $count);
        extract($paginate);

        if($page > $lastpage) return $response->withRedirect($router->pathFor('home'));

        $query = $meme->orderBy('id', 'DESC');

        $paginate['type'] = 1;

        return $view->render($response, 'home.twig', [
            'pagination' => $paginate,
            'memes' => $query->limit($limit)->skip($skip)->get()
        ]);
    }

    public function showTOS(Request $request, Response $response, Twig $view) {
        return $view->render($response, 'tos.twig', [
            
        ]);
    }
}
