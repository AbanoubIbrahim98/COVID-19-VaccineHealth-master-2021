
<?php
/**
 * Created by PhpStorm.
 * User: kelvin mbwilo
 * Date: 6/1/14
 * Time: 5:28 AM
 */
class NationalInventory extends Eloquent{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'national_inventory';

    protected  $guarded = array('id');

    public function user(){
        return $this->belongsTo('User', 'sender', 'id');
    }

    public function vaccine(){
        return $this->BelongsTo('Vaccine', 'GTIN', 'GTIN');
    }

    public function manufacturer(){
        return $this->belongsTo("ManufacturePackage","lot_number","lot_number");
    }

}