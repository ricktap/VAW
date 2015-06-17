<?php
require 'vendor/autoload.php';

$app = new \Slim\Slim();

$app->get('/passenger/:id', 'VAW\Controller\IndexController:run');

$app->run();
