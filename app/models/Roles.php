<?php
/**
 * Created by PhpStorm.
 * User: hrhis
 * Date: 6/1/14
 * Time: 5:32 AM
 */

class Roles extends Eloquent{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

    protected  $guarded = array('id');
    public function getUsers(){
        return $this->hasMany("users");
    }
} 