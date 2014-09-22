<?php
/**
 * Created by PhpStorm.
 * User: kelvin
 * Date: 2/17/14
 * Time: 9:04 PM
 */
class ServerColposcopyStatus extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'colposcopy_status';
    protected $connection = 'mysql2';
    protected  $guarded = array('id');

    public function patient(){
        return $this->belongsTo('ServerPatient', 'patient_id', 'id');
    }

    public function visit(){
        return $this->belongsTo('ServerVisit', 'visit_id', 'id');
    }

    public function result(){
        return $this->belongsTo("ServerColposcopyResult","result_id","id");
    }

}