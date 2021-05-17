<?php
/**
 * Created by PhpStorm.
 * User: kelvin
 * Date: 2/17/14
 * Time: 9:04 PM
 */
class District extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'districts';

    protected  $guarded = array('id');
    public $timestamps = false;

    public function region(){
        return $this->belongsTo('Region', 'region_id', 'id');
    }

    public function arrivals(){
        return $this->hasMany('ArrivalDistrict', 'district_id', 'id');
    }

    public function stock(){
        return $this->hasMany('DistrictStock', 'district_id', 'id');
    }

    public function package(){
        return $this->hasMany('DistrictPackage', 'district_id', 'id');
    }

    public function facility(){
        return $this->hasMany('Facility', 'district_id', 'id');
    }

}