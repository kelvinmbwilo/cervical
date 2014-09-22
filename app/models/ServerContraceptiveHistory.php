<?php
/**
 * Created by PhpStorm.
 * User: kelvin
 * Date: 2/17/14
 * Time: 9:04 PM
 */
class ServerContraceptiveHistory extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contraceptive_history';
    protected $connection = 'mysql2';
    protected  $guarded = array('id');

    public function patient(){
        return $this->belongsTo('ServerPatient', 'patient_id', 'id');
    }

    public function visit(){
        return $this->belongsTo('ServerVisit', 'visit_id', 'id');
    }

    public function current(){
        return $this->belongsTo("ServerContraceptiveResult","current_contraceptive_id","id");
    }

    public function previous(){
        return $this->belongsTo("ServerContraceptiveResult","previous_contraceptive_id","id");
    }

}