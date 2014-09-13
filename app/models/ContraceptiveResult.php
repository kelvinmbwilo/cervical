<?php
/**
 * Created by PhpStorm.
 * User: kelvin
 * Date: 2/17/14
 * Time: 9:04 PM
 */
class ContraceptiveResult extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contraceptive_results';

    protected  $guarded = array('id');

    public function current(){
        return $this->hasMany("ContraceptiveHistory","current_contraceptive_id","id");
    }

    public function previous(){
        return $this->hasMany("ContraceptiveHistory","previous_contraceptive_id","id");
    }

}