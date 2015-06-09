<?php
require 'vendor/autoload.php';
use Symfony\Component\Yaml\Parser;

$app = new \Slim\Slim();

$app->group('/api', function () use ($app) {
    $yaml = new Parser();
    $passengers = $yaml->parse(file_get_contents("passengers.yml"));

    $app->get('/', function () use ($app) {
        $app->response->setStatus(200);
        echo "Flight API Mock v1.0";
    });

    $app->get('/list', function () use ($app, $passengers) {
        $app->response->headers->set('Content-Type', 'application/json;charset=utf-8');
        $app->response->setStatus(200);

        $passengerArray = array_map(
            function ($passenger) {
                return [
                    "Id" => $passenger['Id'],
                    "Bordkartennummer" => $passenger['Bordkartennummer']
                ];
            },
            $passengers
        );

        $app->response->setBody(json_encode($passengerArray));
    });

    $app->get('/:id', function ($id) use ($app, $passengers) {
        $app->response->headers->set('Content-Type', 'application/json;charset=utf-8');
        $app->response->setStatus(200);

        foreach ($passengers as $passenger) {
            if ($passenger['Bordkartennummer'] == $id) {
                $app->response->setBody(json_encode($passenger));
                return;
            }
        }

        $app->response->setStatus(404);
        echo "Passenger not found!";
    });
});

$app->run();
