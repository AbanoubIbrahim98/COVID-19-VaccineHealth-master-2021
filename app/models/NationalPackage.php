<?php
/**
 * Created by PhpStorm.
 * User: kelvin mbwilo
 * Date: 6/1/14
 * Time: 5:28 AM
 */
class NationalPackage extends Eloquent{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'national_package';

    protected  $guarded = array('id');

    public function region(){
        return $this->belongsTo('Region', 'region_id', 'id');
    }

    public function packages(){
        return $this->hasMany('NationalPackageContent', 'package_id', 'id');
    }

    public function sender(){
        return $this->belongsTo('User', 'sender', 'id');
    }

    public function receiver(){
        return $this->BelongsTo('User', 'receiver', 'id');
    }

} 