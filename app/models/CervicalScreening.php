<?php
/**
 * Created by PhpStorm.
 * User: kelvin
 * Date: 2/17/14
 * Time: 9:04 PM
 */
class CervicalScreening extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cervical_screening';

    protected  $guarded = array('id');

    public function patient(){
        return $this->belongsTo('Patient', 'patient_id', 'id');
    }


}