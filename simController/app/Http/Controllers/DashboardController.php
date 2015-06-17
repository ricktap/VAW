<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Httpful\Request as HttpRequest;
use App\Jobs\SimulatePassenger;
use Illuminate\Support\Facades\Queue;
use Carbon\Carbon;
use Illuminate\Support\Facades\Event;

class DashboardController extends Controller
{
    public function index()
    {
        return view("welcome");
    }

    public function run()
    {
        $passengers = $this->getAllPassengers();

        if (count($passengers) === 0) {
            return 0;
        }

        $counter = 0;
        for ($i = 0; $i < 4; $i++) {
            foreach ($passengers as $passenger) {
                $job = (new SimulatePassenger($passenger->Bordkartennummer))->onQueue('baggages');
                $this->dispatch($job);
                $counter++;
                //Event::fire(new \App\Events\BaggageCreated(["Id" => 123, "baggages" => []]));
            }
        }

        return $counter;
    }

    private function getAllPassengers()
    {
        $response = HttpRequest::get("http://flight.vaw.local:8888/api/list")->send();

        if ($response->code < 300 && $response->body !== null) {
            return $response->body;
        }
        return [];
    }
}
