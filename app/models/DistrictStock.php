<?php

class DistrictStock extends Eloquent  {

/**
* The database table used by the model.
*
* @var string
*/
    protected $table = 'district_stock';

    protected $guarded = array("id");

    public function district(){
        return $this->belongsTo('District', 'district_id', 'id');
    }

    public function manufacturer(){
        return $this->belongsTo("ManufacturePackage","lot_number","lot_number");
    }

    public function vaccine(){
        return $this->belongsTo("Vaccine","vaccine_id",'GTIN');
    }
}