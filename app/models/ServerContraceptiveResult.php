<?php
/**
 * Created by PhpStorm.
 * User: kelvin
 * Date: 2/17/14
 * Time: 9:04 PM
 */
class ServerContraceptiveResult extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contraceptive_results';
    protected $connection = 'mysql2';
    protected  $guarded = array('id');

    public function current(){
        return $this->hasMany("ServerContraceptiveHistory","current_contraceptive_id","id");
    }

    public function previous(){
        return $this->hasMany("ServerContraceptiveHistory","previous_contraceptive_id","id");
    }

}