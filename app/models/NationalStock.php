<?php

class NationalStock extends Eloquent  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'national_stock';

    protected $guarded = array("id");

    public function manufacturer(){
        return $this->belongsTo("ManufacturePackage","lot_number","lot_number");
    }

    public function vaccine(){
        return $this->belongsTo("Vaccine","GTIN",'GTIN');
    }

}
