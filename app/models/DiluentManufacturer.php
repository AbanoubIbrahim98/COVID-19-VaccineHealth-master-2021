<?php
/**
 * Created by PhpStorm.
 * User: hrhis
 * Date: 5/31/14
 * Time: 11:02 PM
 */

class DiluentManufacturer extends Eloquent{

    protected $table = 'diluent_manufacturer';

    protected $guarded = array("id");

    public function diluent(){
        return $this->belongsTo("Diluent","diluent_id",'id');
    }

    public function manufacturer(){
        return $this->belongsTo("Manufacturer","manufacturer_id","id");
    }

} 