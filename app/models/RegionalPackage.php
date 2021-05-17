<?php
/**
 * Created by PhpStorm.
 * User: kelvin
 * Date: 2/17/14
 * Time: 9:04 PM
 */
class RegionalPackage extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'regional_package';

    protected  $guarded = array('id');

    public function region(){
        return $this->belongsTo('Region', 'source_id', 'id');
    }

    public function sender(){
        return $this->hasMany('User', 'sender', 'id');
    }

    public function receiver(){
        return $this->hasMany('User', 'receiver', 'id');
    }

    public function district(){
        return $this->belongsTo('District', 'district_id', 'id');
    }

    public function packages(){
        return $this->hasMany('RegionalPackageContent', 'package_id', 'id');
    }
}