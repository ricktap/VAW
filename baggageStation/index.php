<?php
require 'vendor/autoload.php';

$app = new \Slim\Slim([
    'view' => new \Slim\Views\Twig(),
    'templates.path' => 'templates'
]);

$app->contentType('text/html; charset=utf-8');

$view = $app->view();

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


$app->get('/dropBaggage', function () use ($app) {
    $weight = rand(1, 60);
    if ($app->request->params('weight')) {
        $weight = $app->request->params('weight');
    }

    $app->render('drop-baggage.html', [
        "weight" => $weight,
        "allowedWeight" => 30
    ]);
});

$app->get('/anotherBag', function () use ($app) {
    $app->render('another-bag.html');
});

$app->get('/decideCustoms', function () use ($app) {
    $app->render('customs-decide.html');
});


$app->run();
