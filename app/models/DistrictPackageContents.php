<?php
/**
 * Created by PhpStorm.
 * User: kelvin
 * Date: 2/17/14
 * Time: 9:04 PM
 */
class DistrictPackageContents extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'district_package_contents';

    protected  $guarded = array('id');

    public function package(){
        return $this->belongsTo('DistrictPackage', 'package_id', 'id');
    }

    public function manufacturer(){
        return $this->belongsTo("ManufacturePackage","lot_number","lot_number");
    }

    public function vaccine(){
        return $this->belongsTo("Vaccine","vaccine_id",'id');
    }
}