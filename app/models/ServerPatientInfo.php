<?php
/**
 * Created by PhpStorm.
 * User: kelvin
 * Date: 2/17/14
 * Time: 9:04 PM
 */
class ServerPatientInfo extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'patient_info';
    protected $connection = 'mysql2';
    protected  $guarded = array('id');

    public function patient(){
        return $this->belongsTo('ServerPatient', 'patient_id', 'id');
    }

    public function visit(){
        return $this->belongsTo('ServerVisit', 'visit_id', 'id');
    }

    public function regions(){
        return $this->belongsTo('ServerRegion', 'region', 'id');
    }

    public function districts(){
        return $this->belongsTo('ServerDistrict', 'district', 'id');
    }


}