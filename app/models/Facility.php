<?php
/**
 * Created by PhpStorm.
 * User: kelvin
 * Date: 2/17/14
 * Time: 9:04 PM
 */
class Facility extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'facilities';

    protected  $guarded = array('id');

    public function region(){
        return $this->belongsTo('Region', 'region', 'id');
    }

    public function district(){
        return $this->belongsTo('District', 'district', 'id');
    }


}