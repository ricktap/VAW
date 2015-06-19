<?php
require 'vendor/autoload.php';

$app = new \Slim\Slim([
    'view' => new \Slim\Views\Twig(),
    'templates.path' => 'templates'
]);

$app->contentType('text/html; charset=utf-8');

$view = $app->view();
// $view->parserDirectory = 'vendor/slim';

$view->parserOptions = array(
    'charset' => 'utf-8',
);

$view->parserExtensions = array(
    new \Slim\Views\TwigExtension(),
);

$app->get('/passenger/:id', 'VAW\Controller\IndexController:run');
$app->get('/login', function () use ($app) {
    $app->render('login.html');
});
$app->get('/passengerDataConfirm', function () use ($app) {
    $app->render('passenger-data-confirm.html');
});

$app->run();
