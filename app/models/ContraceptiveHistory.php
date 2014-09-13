<?php
/**
 * Created by PhpStorm.
 * User: kelvin
 * Date: 2/17/14
 * Time: 9:04 PM
 */
class ContraceptiveHistory extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contraceptive_history';

    protected  $guarded = array('id');

    public function patient(){
        return $this->belongsTo('Patient', 'patient_id', 'id');
    }

    public function visit(){
        return $this->belongsTo('Visit', 'visit_id', 'id');
    }

    public function current(){
        return $this->belongsTo("ContraceptiveResult","current_contraceptive_id","id");
    }

    public function previous(){
        return $this->belongsTo("ContraceptiveResult","previous_contraceptive_id","id");
    }

}