<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use \Httpful\Request as HttpRequest;
use Illuminate\Support\Facades\Event;

class SimulatePassenger extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    public $bordkartennummer;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($bordkartennummer)
    {
        $this->bordkartennummer = $bordkartennummer;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $passengerData = $this->simulatePassengerOnInput($this->bordkartennummer);
        Event::fire(new \App\Events\BaggageCreated($passengerData));
    }

    protected function simulatePassengerOnInput($bordkartennummer)
    {
        $response = HttpRequest::get("http://baggage.vaw.local:8888/passenger/{$bordkartennummer}")->send();
        if ($response->code < 300 && $response->body !== null) {
            return $response->body;
        }
        return ["id" => $bordkartennummer];
    }
}
