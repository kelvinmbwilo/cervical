<?php
/**
 * Created by PhpStorm.
 * User: kelvin
 * Date: 2/17/14
 * Time: 9:04 PM
 */
class ServerPapsmearStatus extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'papsmear_status';
    protected $connection = 'mysql2';
    protected  $guarded = array('id');

    public function patient(){
        return $this->belongsTo('Patient', 'patient_id', 'id');
    }

    public function visit(){
        return $this->belongsTo('ServerVisit', 'visit_id', 'id');
    }

    public function result(){
        return $this->belongsTo('ServerPapsmearResult', 'result_id', 'id');
    }




}