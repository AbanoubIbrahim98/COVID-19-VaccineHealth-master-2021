<?php
/**
 * Created by PhpStorm.
 * User: kelvin mbwilo
 * Date: 6/1/14
 * Time: 5:28 AM
 */
class DistrictInventory extends Eloquent{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'district_inventory';

    protected  $guarded = array('id');

    public function user(){
        return $this->belongsTo('User', 'user_id', 'id');
    }

    public function vaccine(){
        return $this->BelongsTo('Vaccine', 'GTIN', 'GTIN');
    }

    public function manufacturer(){
        return $this->belongsTo("ManufacturePackage","lot_number","lot_number");
    }

}