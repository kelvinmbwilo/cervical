<?php
/**
 * Created by PhpStorm.
 * User: kelvin
 * Date: 2/17/14
 * Time: 9:04 PM
 */
class InterventionResult extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'intervention_result';

    protected  $guarded = array('id');

    public function intervention(){
        return $this->hasMany('Intervention', 'type_id', 'id');
    }

}