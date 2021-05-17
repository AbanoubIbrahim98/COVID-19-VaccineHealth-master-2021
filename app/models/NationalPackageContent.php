<?php
/**
 * Created by PhpStorm.
 * User: kelvin mbwilo
 * Date: 6/1/14
 * Time: 5:28 AM
 */
class NationalPackageContent extends Eloquent{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'national_package_contents';

    protected  $guarded = array('id');

    public function package(){
        return $this->belongsTo('NationalPackage', 'package_id', 'id');
    }

    public function manufacturer(){
        return $this->belongsTo("ManufacturePackage","lot_number","lot_number");
    }

    public function vaccine(){
        return $this->belongsTo("Vaccine","vaccine_id",'id');
    }
}