<?php
/**
 * Created by PhpStorm.
 * User: kelvin
 * Date: 2/17/14
 * Time: 9:04 PM
 */
class ServerFacility extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'facilities';
    protected $connection = 'mysql2';
    protected  $guarded = array('id');

    public function getregion(){
        return $this->belongsTo('ServerRegion', 'region', 'id');
    }

    public function getdistrict(){
        return $this->belongsTo('ServerDistrict', 'district', 'id');
    }


}