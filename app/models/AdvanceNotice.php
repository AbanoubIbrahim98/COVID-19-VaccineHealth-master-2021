<?php
/**
 * Created by PhpStorm.
 * User: kelvin mbwilo
 * Date: 6/1/14
 * Time: 5:30 AM
 */

class AdvanceNotice extends Eloquent{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'advance_notice';

    protected  $guarded = array('id');

    public function arrival(){
        return $this->belongsTo('ArrivalNational', 'package_id', 'id');
    }
} 