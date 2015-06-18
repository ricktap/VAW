<?php
namespace VAW\Helper;

use \Httpful\Request;

class ServerApi
{
    private $baseUrl;

    public function __construct($url)
    {
        $this->baseUrl = $url;
    }

    /**
     * Grabs the baggage id from the server
     * @return int new baggage id, created on the server
     */
    public function getBaggageId($passengerId)
    {
        $response = Request::post("{$this->baseUrl}/baggage?passenger_id={$passengerId}")
            ->send();

        if ($response->body !== null && $response->body->id !== null) {
            return $response->body->id;
        }

        return [];
    }
}
