<?php
/**
 * Created by PhpStorm.
 * User: kelvin
 * Date: 2/17/14
 * Time: 9:04 PM
 */
class ServerRegion extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'regions';
    protected $connection = 'mysql2';
    protected  $guarded = array('id');

    public function district(){
        return $this->hasMany('ServerDistrict', 'region_id', 'id');
    }

    public function facilities(){
        return $this->hasMany('ServerFacility', 'region', 'id');
    }

}