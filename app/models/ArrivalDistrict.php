<?php
/**
 * Created by PhpStorm.
 * User: hrhis
 * Date: 6/1/14
 * Time: 5:30 AM
 */

class ArrivalDistrict extends Eloquent{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'arrival_district';

    protected  $guarded = array('id');

    public function vaccine(){
        return $this->belongsTo("Vaccine","vaccine_id",'id');
    }

    public function region_package(){
        return $this->belongsTo("RegionalPackage","regional_package",'id');
    }

    public function district(){
        return $this->belongsTo("District","district_id",'id');
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