<?php
/**
 * Created by PhpStorm.
 * User: hrhis
 * Date: 5/31/14
 * Time: 11:06 PM
 */

class VaccineProblems extends Eloquent {

    protected $table = 'vaccine_problems';

    protected $guarded = array("id");

    public function manufacturer(){
        return $this->belongsTo("ManufacturePackage","lot_number","lot_number");
    }

}