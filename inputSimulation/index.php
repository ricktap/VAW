<?php
require 'vendor/autoload.php';

$app = new \Slim\Slim();

$app->get('/', 'VAW\Controller\IndexController:run');

$app->run();
