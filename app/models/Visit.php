<?php
/**
 * Created by PhpStorm.
 * User: kelvin
 * Date: 2/17/14
 * Time: 9:04 PM
 */
class Visit extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'visit';

    protected  $guarded = array('id');

    public function patient(){
        return $this->belongsTo('Patient', 'id', 'patient_id');
    }

    public function via(){
        return $this->belongsTo('ViaStatus', 'id', 'visit_id');
    }

    public function papsmear(){
        return $this->belongsTo('PapsmearStatus', 'id', 'visit_id');
    }

    public function hiv(){
        return $this->belongsTo('HivStatus', 'id', 'visit_id');
    }


    public function intervention(){
        return $this->belongsTo('Intervention', 'id', 'visit_id');
    }

    public function gynecology(){
        return $this->belongsTo("GynecologicalHistory","id","visit_id");
    }

    public function contraceptive(){
        return $this->belongsTo("ContraceptiveHistory","id","visit_id");
    }

    public function info(){
        return $this->belongsTo('PatientInfo', 'id', 'visit_id');
    }

    public function colposcopy(){
        return $this->belongsTo("ColposcopyStatus", 'id', 'visit_id');
    }

    public function papsmea(){
        return $this->belongsTo("PapsmearStatus", 'id', 'visit_id');
    }

}