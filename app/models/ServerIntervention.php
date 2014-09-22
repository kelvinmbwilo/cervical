<?php
/**
 * Created by PhpStorm.
 * User: kelvin
 * Date: 2/17/14
 * Time: 9:04 PM
 */
class ServerIntervention extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'intervention';
    protected $connection = 'mysql2';
    protected  $guarded = array('id');

    public function patient(){
        return $this->belongsTo('ServerPatient', 'patient_id', 'id');
    }

    public function visit(){
        return $this->belongsTo('ServerVisit', 'visit_id', 'id');
    }

    public function indicator(){
        return $this->belongsTo('ServerInterventionIndicators', 'indicator_id', 'id');
    }

    public function cancer(){
        return $this->belongsTo('ServerCancerType', 'cancer_id', 'id');
    }

    public function histology(){
        return $this->belongsTo('ServerHistologyResult', 'histology_id', 'id');
    }

    public function result(){
        return $this->belongsTo('ServerInterventionResult','type_id','id');
    }

}