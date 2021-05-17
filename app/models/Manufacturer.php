<?php
/**
 * Created by PhpStorm.
 * User: kelvin Mbwilo
 * Date: 5/31/14
 * Time: 11:12 PM
 */

class Manufacturer extends Eloquent{
    protected $table = 'manufacturer';

    protected $guarded = array("id");

    public function getBarcode(){
        return $this->hasMany("ManufacturerBarcode","manufacture_id",'id');
    }

    public function getCountry(){
        return $this->belongsTo("Country","country",'id');
    }

    public function vaccine(){
        return $this->hasMany("VaccineManufacturer","manufacturer_id","id");
    }

    public function diluent(){
        return $this->hasMany("DiluentManufacturer","manufacturer_id","id");
    }
}