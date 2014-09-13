<?php
/**
 * Created by PhpStorm.
 * User: kelvin
 * Date: 2/17/14
 * Time: 9:04 PM
 */
class Intervention extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'intervention';

    protected  $guarded = array('id');

    public function patient(){
        return $this->belongsTo('Patient', 'patient_id', 'id');
    }

    public function visit(){
        return $this->belongsTo('Visit', 'visit_id', 'id');
    }

    public function indicator(){
        return $this->belongsTo('InterventionIndicators', 'indicator_id', 'id');
    }

    public function cancer(){
        return $this->belongsTo('CancerType', 'cancer_id', 'id');
    }

    public function histology(){
        return $this->belongsTo('HistologyResult', 'histology_id', 'id');
    }

    public function result(){
        return $this->belongsTo('InterventionResult','type_id','id');
    }

}