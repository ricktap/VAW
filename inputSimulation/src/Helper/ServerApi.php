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
     * @todo currently just a mockup, needs to call the real server (still string atm)
     */
    public function getBaggageId()
    {
        return uniqid();
    }
}
