<?php
/**
 * Created by PhpStorm.
 * User: kelvin
 * Date: 2/17/14
 * Time: 9:04 PM
 */
class PapsmearResult extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'papsmear_result';

    protected  $guarded = array('id');

    public function status(){
        return $this->hasMany('Papsmearstatus', 'result_id', 'id');
    }


}