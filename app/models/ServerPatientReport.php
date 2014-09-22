<?php
/**
 * Created by PhpStorm.
 * User: kelvin
 * Date: 2/17/14
 * Time: 9:04 PM
 */
class ServerPatientReport extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'patient_report';
    protected $connection = 'mysql2';
    protected  $guarded = array('id');

    public function regions(){
        return $this->belongsTo('ServerRegion', 'region', 'id');
    }

    public function districts(){
        return $this->belongsTo('ServerDistrict', 'district', 'id');
    }
}