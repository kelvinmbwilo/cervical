<?php
/**
 * Created by PhpStorm.
 * User: kelvin
 * Date: 2/17/14
 * Time: 9:04 PM
 */
class ServerVisit extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'visit';
    protected $connection = 'mysql2';
    protected  $guarded = array('id');

    public function patient(){
        return $this->belongsTo('ServerPatient', 'patient_id', 'id');
    }

    public function via(){
        return $this->belongsTo('ServerViaStatus', 'id', 'visit_id');
    }

    public function papsmear(){
        return $this->belongsTo('ServerPapsmearStatus', 'id', 'visit_id');
    }

    public function hiv(){
        return $this->belongsTo('ServerHivStatus', 'id', 'visit_id');
    }


    public function intervention(){
        return $this->belongsTo('ServerIntervention', 'id', 'visit_id');
    }

    public function gynecology(){
        return $this->belongsTo("ServerGynecologicalHistory","id","visit_id");
    }

    public function contraceptive(){
        return $this->belongsTo("ServerContraceptiveHistory","id","visit_id");
    }

    public function info(){
        return $this->belongsTo('ServerPatientInfo', 'id', 'visit_id');
    }

    public function colposcopy(){
        return $this->belongsTo("ServerColposcopyStatus", 'id', 'visit_id');
    }

    public function papsmea(){
        return $this->belongsTo("ServerPapsmearStatus", 'id', 'visit_id');
    }

}