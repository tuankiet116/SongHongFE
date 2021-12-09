<?php
namespace App\Repositories\Repo\Properties;

use App\Models\PropertiesModel;
use App\Repositories\Interfaces\PropertiesInterface;

class PropertiesRepo implements PropertiesInterface{
    public function getListingProperties()
    {
        $properties = PropertiesModel::groupBy('value', 'keyname')->get();
        $properties_list = array();
        $properties_test = array();
        foreach ($properties as $items) {
            if (!isset($properties_list[trim($items->keyname)]) || !is_array($properties_list[trim($items->keyname)])) {
                $properties_list[trim($items->keyname)] = array();
            }

            if (!isset($properties_test[preg_replace('/\s+/', '',$items->keyname)]) || !is_array($properties_test[preg_replace('/\s+/', '',$items->keyname)])) {
                $properties_test[preg_replace('/\s+/', '',$items->keyname)] = array();
            }

            if (!in_array(preg_replace('/\s+/', '', $items->value), $properties_test[preg_replace('/\s+/', '',$items->keyname)])) {
                array_push($properties_test[preg_replace('/\s+/', '',$items->keyname)], preg_replace('/\s+/', '', $items->value));
                array_push($properties_list[trim($items->keyname)], trim($items->value));
            }
        }
        return $properties_list;
    }
}