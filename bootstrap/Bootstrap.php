<?php
require __DIR__ . '/../vendor/autoload.php';

session_start();

use Respect\Validation\Validator as v;
use \App\App;
use Slim\Views\Twig;
use Illuminate\Database\Capsule\Manager as Capsule;
use \Slim\Csrf\Guard;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Router;
use Slim\Flash\Messages;

$app = new App();

$container = $app->getContainer();

$capsule = new Capsule;

$capsule->addConnection([
	'driver' => 'mysql',
	'host' => 'localhost',
	'database' => 'meme',
	'username' => 'root',
	'password' => '',
	'charset' => 'utf8',
	'collation' => 'utf8_unicode_ci',
	'prefix' => ''
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

require __DIR__ . '/../app/routes.php';

$app->add($container->get(Guard::class));

$app->add(new \App\Middleware\UserAuth($container->get(Twig::class)));
$app->add(new \App\Middleware\ValidationErrors($container->get(Twig::class)));
$app->add(new \App\Middleware\OldInput($container->get(Twig::class)));
$app->add(new \App\Middleware\UserData($container->get(Twig::class)));

$app->add(new \App\Middleware\InboxChecker($container->get(Twig::class), $container->get(Router::class), $container->get(Messages::class)));

v::with('App\\Validator\\Rules\\');
