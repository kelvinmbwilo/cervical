<?php
/**
 * Created by PhpStorm.
 * User: kelvin
 * Date: 2/17/14
 * Time: 9:04 PM
 */
class Patient extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'patient';

    protected  $guarded = array('id');

    public function visit(){
        return $this->hasMany('Visit', 'patient_id', 'id');
    }
    public function report(){
        return $this->belongsTo('PatientReport', 'id', 'patient_id');
    }

    public function info(){
        return $this->hasMany('PatientInfo', 'patient_id', 'id');
    }

    public function via(){
        return $this->hasMany('ViaStatus', 'patient_id', 'id');
    }

    public function papsmear(){
        return $this->hasMany('PapsmearStatus', 'patient_id', 'id');
    }

    public function hiv(){
        return $this->hasMany('HivStatus', 'patient_id', 'id');
    }

    public function intervention(){
        return $this->hasMany('Intervention', 'patient_id', 'id');
    }

    public function contraceptive(){
        return $this->hasMany("ContraceptiveHistory","patient_id","id");
    }

    public function gynocology(){
        return $this->hasMany("GynecologicalHistory","patient_id","id");
    }

    public function colposcopy(){
        return $this->hasMany("ColposcopyStatus","patient_id","id");
    }

    public function papsmea(){
        return $this->hasMany("PapsmearStatus","patient_id","id");
    }

}