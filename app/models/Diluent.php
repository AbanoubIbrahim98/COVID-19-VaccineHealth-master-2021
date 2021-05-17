<?php
/**
 * Created by PhpStorm.
 * User: hrhis
 * Date: 6/1/14
 * Time: 5:22 AM
 */

class Diluent extends Eloquent{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'diluent';

    protected  $guarded = array('id');

    public function vaccine(){
        return $this->belongsTo("Vaccine","vaccine_id",'id');
    }

    public function manufacturer(){
        return $this->hasMany("DiluentManufacturer","diluent_id","id");
    }

} 