<?php
namespace App\Services;
use App\Repositories\Interfaces\PropertiesInterface;

class PropertiesService{
    private $properties;
    public function __construct(PropertiesInterface $properties){
        $this->properties = $properties;
    }

    public function getListPropertiesInArray(){
        return $this->properties->getListingProperties();
    }
}