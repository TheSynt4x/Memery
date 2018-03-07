<?php
use Slim\Router;
use Slim\Flash\Messages;

use Slim\Views\Twig;

$app->get('/', ['App\Controllers\Home\Home', 'index'])->setName('home');

$app->group('', function() use($app) {
    $app->get('/login', ['App\Controllers\Auth\Login', 'show'])->setName('login');
    $app->post('/login', ['App\Controllers\Auth\Login', 'login']);

    $app->get('/register', ['App\Controllers\Auth\Signup', 'show'])->setName('register');
    $app->post('/register', ['App\Controllers\Auth\Signup', 'register']);

    $app->get('/tos', ['App\Controllers\Home\Home', 'showTOS'])->setName('tos');

})->add(new \App\Middleware\Guest($container->get(Router::class)));

$app->group('', function() use($app) {
    $app->get('/acp/ban/{username}', ['App\Controllers\Admin\Admin', 'ban'])->setName('admin.ban');
    $app->get('/acp/warn/{username}', ['App\Controllers\Admin\Admin', 'warn'])->setName('admin.warn');
    $app->get('/acp/delete/{id}', ['App\Controllers\Admin\Admin', 'delete'])->setName('admin.delete');

})->add(new \App\Middleware\Admin($container->get(Router::class), $container->get(Messages::class)));

$app->group('', function() use($app) {
    $app->get('/upload', ['App\Controllers\Home\Upload', 'show'])->setName('upload');
    $app->post('/upload', ['App\Controllers\Home\Upload', 'upload']);

    $app->get('/ucp/avatar', ['App\Controllers\User\Avatar', 'show'])->setName('avatar');
    $app->post('/ucp/avatar', ['App\Controllers\User\Avatar', 'change']);

    $app->get('/ucp/password', ['App\Controllers\User\Password', 'show'])->setName('password');
    $app->post('/ucp/password', ['App\Controllers\User\Password', 'change']);

    $app->get('/edit/{id}', ['App\Controllers\Home\Meme', 'edit'])->setName('meme.edit');
    $app->post('/edit/{id}', ['App\Controllers\Home\Meme', 'postEdit']);

    $app->get('/delete/{id}', ['App\Controllers\Home\Meme', 'delete'])->setName('meme.delete');

    $app->get('/inbox/browse', ['App\Controllers\Inbox\Inbox', 'show'])->setName('inbox');
    $app->get('/inbox/sent', ['App\Controllers\Inbox\Inbox', 'showSent'])->setName('inbox.sent');
    $app->get('/inbox/compose', ['App\Controllers\Inbox\Inbox', 'showCompose'])->setName('inbox.compose');
    $app->post('/inbox/compose', ['App\Controllers\Inbox\Inbox', 'compose']);
    $app->get('/inbox/msg-{id}', ['App\Controllers\Inbox\Inbox', 'showReceived'])->setName('inbox.received');

    //$app->get('/vote/{type}/{id}', ['App\Controllers\Home\Votes', 'vote'])->setName('vote');
    $app->get('/vote/{type}/{id}', ['App\Controllers\Home\Votes', 'newVoting'])->setName('vote');

    $app->get('/profile/{name}', ['App\Controllers\Home\Profile', 'getProfile'])->setName('profile');

    $app->get('/logout', ['App\Controllers\Auth\Login', 'logout'])->setName('logout');
})->add(new \App\Middleware\Auth($container->get(Router::class), $container->get(Messages::class)));

$app->get('/comments/{id}', ['App\Controllers\Home\Meme', 'getComments'])->setName('comments');
$app->get('/meme/{id}', ['App\Controllers\Home\Meme', 'getMeme'])->setName('meme');
$app->post('/meme/{id}', ['App\Controllers\Home\Meme', 'comment']);

$app->get('/front', ['App\Controllers\Home\Meme', 'getFront'])->setName('meme.front');
$app->get('/rising', ['App\Controllers\Home\Meme', 'getRising'])->setName('meme.rising');
$app->get('/fresh', ['App\Controllers\Home\Meme', 'getFresh'])->setName('meme.fresh');
