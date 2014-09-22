<?php
/**
 * Created by PhpStorm.
 * User: kelvin
 * Date: 2/17/14
 * Time: 9:04 PM
 */
class ServerCervicalScreening extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cervical_screening';
    protected $connection = 'mysql2';
    protected  $guarded = array('id');

    public function patient(){
        return $this->belongsTo('ServerPatient', 'patient_id', 'id');
    }


}