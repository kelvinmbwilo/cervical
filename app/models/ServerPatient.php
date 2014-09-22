<?php
/**
 * Created by PhpStorm.
 * User: kelvin
 * Date: 2/17/14
 * Time: 9:04 PM
 */
class ServerPatient extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'patient';
    protected $connection = 'mysql2';
    protected  $guarded = array('id');

    public function visit(){
        return $this->hasMany('ServerVisit', 'patient_id', 'id');
    }
    public function report(){
        return $this->belongsTo('ServerPatientReport', 'id', 'patient_id');
    }

    public function info(){
        return $this->hasMany('ServerPatientInfo', 'patient_id', 'id');
    }

    public function via(){
        return $this->hasMany('ServerViaStatus', 'patient_id', 'id');
    }

    public function papsmear(){
        return $this->hasMany('ServerPapsmearStatus', 'patient_id', 'id');
    }

    public function hiv(){
        return $this->hasMany('ServerHivStatus', 'patient_id', 'id');
    }

    public function intervention(){
        return $this->hasMany('ServerIntervention', 'patient_id', 'id');
    }

    public function contraceptive(){
        return $this->hasMany("ServerContraceptiveHistory","patient_id","id");
    }

    public function gynocology(){
        return $this->hasMany("ServerGynecologicalHistory","patient_id","id");
    }

    public function colposcopy(){
        return $this->hasMany("ServerColposcopyStatus","patient_id","id");
    }

    public function papsmea(){
        return $this->hasMany("ServerPapsmearStatus","patient_id","id");
    }

}