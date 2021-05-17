<?php

class Country extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'countries';

    protected  $guarded = array('id');

    public function manufacture(){
        return $this->hasMany('Manufacture', 'country', 'id');
    }


}