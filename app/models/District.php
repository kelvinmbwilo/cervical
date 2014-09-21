<?php
/**
 * Created by PhpStorm.
 * User: kelvin
 * Date: 2/17/14
 * Time: 9:04 PM
 */
class District extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'districts';

    protected  $guarded = array('id');

    public function region(){
        return $this->belongsTo('Region', 'region_id', 'id');
    }

    public function facilities(){
        return $this->hasMany('Facility', 'district', 'id');
    }



}