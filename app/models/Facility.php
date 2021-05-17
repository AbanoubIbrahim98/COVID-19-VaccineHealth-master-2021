<?php
/**
 * Created by PhpStorm.
 * User: kelvin mbwilo
 * Date: 6/1/14
 * Time: 5:30 AM
 */

class Facility extends Eloquent{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'facility';

    protected  $guarded = array('id');

    public function district(){
        return $this->belongsTo('District', 'district_id', 'id');
    }
} 