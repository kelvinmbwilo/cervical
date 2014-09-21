<?php
/**
 * Created by PhpStorm.
 * User: kelvin
 * Date: 2/17/14
 * Time: 9:04 PM
 */
class PatientReport extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'patient_report';

    protected  $guarded = array('id');

    public function regions(){
        return $this->belongsTo('Region', 'region', 'id');
    }

    public function districts(){
        return $this->belongsTo('District', 'district', 'id');
    }
}