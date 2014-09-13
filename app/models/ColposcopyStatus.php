<?php
/**
 * Created by PhpStorm.
 * User: kelvin
 * Date: 2/17/14
 * Time: 9:04 PM
 */
class ColposcopyStatus extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'colposcopy_status';

    protected  $guarded = array('id');

    public function patient(){
        return $this->belongsTo('Patient', 'patient_id', 'id');
    }

    public function visit(){
        return $this->belongsTo('Visit', 'visit_id', 'id');
    }

    public function result(){
        return $this->belongsTo("ColposcopyResult","result_id","id");
    }

}