<?php
/**
 * Created by PhpStorm.
 * User: hrhis
 * Date: 6/1/14
 * Time: 5:25 AM
 */

class Vaccine extends Eloquent {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'vaccine';

    protected  $guarded = array('id');

    public function diluent(){
        return $this->hasMany("Diluent",'vaccine_id',"id");
    }

    public function manufacturer(){
        return $this->hasMany("VaccineManufacturer","vaccine_id","id");
    }

    public function region_package(){
        return $this->hasMany("RegionalPackageContent","vaccine_id","id");
    }

    public function district_package(){
        return $this->hasMany("DistrictPackageContent","vaccine_id","id");
    }

    public function national_package(){
        return $this->hasMany("NationalPackageContent","vaccine_id","id");
    }

    public function country(){
        return $this->belongsTo('Country','country_id','id');
    }
} 