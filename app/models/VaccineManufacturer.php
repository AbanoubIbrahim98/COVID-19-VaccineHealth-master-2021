<?php
/**
 * Created by PhpStorm.
 * User: hrhis
 * Date: 5/31/14
 * Time: 11:06 PM
 */

class VaccineManufacturer extends Eloquent {

    protected $table = 'vaccine_manufacturer';

    protected $guarded = array("id");

    public function manufacturer(){
        return $this->hasMany("Manufacturer","manufacturer_id","id");
    }

    public function vaccine(){
        return $this->hasMany("Vaccine","vaccine_id","id");
    }
}