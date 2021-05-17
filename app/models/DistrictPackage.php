<?php
/**
 * Created by PhpStorm.
 * User: kelvin
 * Date: 2/17/14
 * Time: 9:04 PM
 */
class DistrictPackage extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'district_package';

    protected  $guarded = array('id');

    public function district(){
        return $this->belongsTo('District', 'source_id', 'id');
    }

    public function sender(){
        return $this->hasMany('User', 'sender', 'id');
    }

    public function receiver(){
        return $this->hasMany('User', 'receiver', 'id');
    }

    public function getfacility(){
        return $this->belongsTo('Facility', 'facility', 'id');
    }

    public function content(){
        return $this->belongsTo('DistrictPackageContents', 'package_id', 'id');
    }

    public function packages(){
        return $this->hasMany('DistrictPackageContents', 'package_id', 'id');
    }
}