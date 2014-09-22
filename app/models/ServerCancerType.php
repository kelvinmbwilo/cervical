<?php
/**
 * Created by PhpStorm.
 * User: kelvin
 * Date: 2/17/14
 * Time: 9:04 PM
 */
class ServerCancerType extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $connection = 'mysql2';
    protected $table = 'cancer_type';

    protected  $guarded = array('id');

    public function intervention(){
        return $this->hasMany('ServerIntervention', 'cancer_id', 'id');
    }
}