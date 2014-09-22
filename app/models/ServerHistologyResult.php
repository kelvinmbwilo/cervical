<?php
/**
 * Created by PhpStorm.
 * User: kelvin
 * Date: 2/17/14
 * Time: 9:04 PM
 */
class ServerHistologyResult extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'histology_result';
    protected $connection = 'mysql2';
    protected  $guarded = array('id');

    public function intervention(){
        return $this->hasMany('ServerIntervention', 'histology_id', 'id');
    }

}