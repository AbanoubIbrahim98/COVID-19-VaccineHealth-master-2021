<?php

class Document extends Eloquent  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'documents';

    protected $guarded = array("id");

    public function arrival(){
        return $this->belongsTo('ArrivalNational', 'package_id', 'id');
    }

}