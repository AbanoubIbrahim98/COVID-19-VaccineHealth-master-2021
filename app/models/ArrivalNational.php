<?php
/**
 * Created by PhpStorm.
 * User: hrhis
 * Date: 6/1/14
 * Time: 5:31 AM
 */

class ArrivalNational extends Eloquent{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'arrival_national';

    protected  $guarded = array('id');

    public function vaccine(){
        return $this->belongsTo("Vaccine","vaccine_id",'id');
    }

    public function manufacturer(){
        return $this->belongsTo("ManufacturePackage","lot_number","lot_number");
    }

    public function packages(){
        return $this->hasMany("ManufacturerBarcode","ssc","ssc");
    }

    public function user(){
        return $this->belongsTo("User","receiver","id");
    }

    public function problem(){
        return $this->hasMany("Problem","arrival_id","id");
    }

    public function notice(){
        return $this->hasMany("AdvanceNotice","package_id","id");
    }

    public function document(){
        return $this->hasMany("Document","package_id","id");
    }

}