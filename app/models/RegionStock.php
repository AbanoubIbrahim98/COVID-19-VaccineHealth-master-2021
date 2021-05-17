<?php

class RegionStock extends Eloquent  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'region_stock';

    protected $guarded = array("id");

    public function region(){
        return $this->belongsTo("Region","region_id",'id');
    }

    public function manufacturer(){
        return $this->belongsTo("ManufacturePackage","lot_number","lot_number");
    }

    public function vaccine(){
        return $this->belongsTo("Vaccine","vaccine_id",'GTIN');
    }


}
