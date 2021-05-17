<?php
/**
 * Created by PhpStorm.
 * User: hrhis
 * Date: 6/1/14
 * Time: 5:29 AM
 */

class ArrivalRegion extends Eloquent{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'arrival_region';

    protected  $guarded = array('id');

    public function vaccine(){
        return $this->belongsTo("Vaccine","vaccine_id",'id');
    }

    public function nation_package(){
        return $this->belongsTo("NationalPackage","national_package",'id');
    }

    public function region(){
        return $this->belongsTo("Region","region_id",'id');
    }

    public function manufacturer(){
        return $this->belongsTo("ManufacturePackage","lot_number","lot_number");
    }

    public function user(){
        return $this->belongsTo("User","receiver","id");
    }

    public function problem(){
        return $this->hasMany("Problem","arrival_id","id");
    }
} 