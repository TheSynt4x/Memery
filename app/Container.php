<?php
use Slim\Views\Twig;
use Slim\Views\TwigExtension;
use Slim\Flash\Messages;

use Interop\Container\ContainerInterface;
use Upload\File;

use App\Models\User;
use App\Validator\Validator;

use \Slim\Csrf\Guard;

return [
	Messages::class => function(ContainerInterface $c) {
		return new Messages();
	},
	Guard::class => function(ContainerInterface $c) {
		return new \Slim\Csrf\Guard;
	},
    Twig::class => function(ContainerInterface $c) {
		$twig = new Twig(__DIR__ . '/../resources/views', [
			'cache' => false
		]);

		$twig->addExtension(new TwigExtension(
			$c->get('router'),
			$c->get('request')->getUri()
		));

		$twig->addExtension(new \App\Views\CsrfExtension($c->get(Guard::class)));

		$currentRoute = explode('/', $c->get('request')->getUri());
		$twig->getEnvironment()->addGlobal('url', $currentRoute);

		$twig->getEnvironment()->addGlobal('title', 'Memery');
		$twig->getEnvironment()->addGlobal('flash', $c->get(Messages::class));

		return $twig;
	},
	Meme::class => function(ContainerInterface $c) {
		return new Meme();
	},
	User::class => function(ContainerInterface $c) {
		return new User();
	},
	Validator::class => function(ContainerInterface $c) {
		return new Validator();
	},
	File::class => function(ContainerInterface $c) {
		return new File('image', new \Upload\Storage\FileSystem(__DIR__ . '/../public/images/'));
	}
];