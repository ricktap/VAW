<?php
namespace VAW\Controller;

use VAW\Helper\FlightApi;
use VAW\Helper\ServerApi;
use VAW\Model\Baggage;

class IndexController
{
    private $app;

    public function __construct()
    {
        $this->app = \Slim\Slim::getInstance();
    }

    public function run()
    {
        $this->app->response->headers->set('Content-Type', 'application/json;charset=utf-8');
        $this->app->response->setStatus(200);

        $flightApi = new FlightApi("http://flight.vaw.local:8888/api");

        $passengers = $flightApi->downloadPassengerList();
        $pOut = array();

        foreach ($passengers as $passenger) {
            $passenger = $flightApi->downloadPassengerData($passenger->Bordkartennummer);
            $pOut[] = $this->generateBaggagesForPassenger($passenger);
        }

        $this->app->response->setBody(json_encode($pOut));
    }

    private function generateBaggagesForPassenger($passenger)
    {
        $serverApi = new ServerApi("http://server.vaw.local:8888/api");
        $passenger->baggages = array();

        for ($i = 0; $i < $this->getRandomBaggageAmount(); $i++) {
            $baggage = new Baggage($serverApi->getBaggageId($passenger->Id));
            $passenger->baggages[] = $baggage->toArray();
        }

        return $passenger;
    }

    // Generators
    private function getRandomBaggageAmount()
    {
        return mt_rand(1, 3);
    }
}
