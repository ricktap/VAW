<?php
require 'vendor/autoload.php';

$app = new \Slim\App();
$container = $app->getContainer();

$container->register(new \Slim\Views\Twig('templates'));

$app->get('/passenger/:id', 'VAW\Controller\IndexController:run');
$app->get('/twig', 'VAW\Controller\IndexController:twig');

$app->run();
