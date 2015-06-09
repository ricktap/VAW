<?php
namespace VAW\Helper;

use \Httpful\Request;

class FlightApi
{
    private $baseUrl;

    public function __construct($url)
    {
        $this->baseUrl = $url;
    }

    public function downloadPassengerList()
    {
        $response = Request::get("{$this->baseUrl}/list")->send();
        if ($response->body !== null) {
            return $response->body;
        }
        return [];
    }

    public function downloadPassengerData($resource)
    {
        $response = Request::get("{$this->baseUrl}/{$resource}")->send();
        if ($response->body !== null) {
            return $response->body;
        }
        return [];
    }
}
