<?php
namespace VAW\Model;

class Baggage
{
    private $id;
    private $weight;

    public function __construct($baggageId)
    {
        $this->id = $baggageId;
        $this->weight = $this->getRandomWeight();
    }

    // toArray
    public function toArray()
    {
        return [
            "id" => $this->id,
            "weight" => $this->weight
        ];
    }

    // Generators
    private function getRandomWeight()
    {
        return floatVal(mt_rand(5, 25).'.'.rand(0, 9));
    }
}
