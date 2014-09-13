<?php
/**
 * Created by PhpStorm.
 * User: kelvin
 * Date: 2/17/14
 * Time: 9:04 PM
 */
class CancerType extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cancer_type';

    protected  $guarded = array('id');

    public function intervention(){
        return $this->hasMany('Intervention', 'cancer_id', 'id');
    }
}