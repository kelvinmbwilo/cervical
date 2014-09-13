<?php
/**
 * Created by PhpStorm.
 * User: kelvin
 * Date: 2/17/14
 * Time: 9:04 PM
 */
class HistologyResult extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'histology_result';

    protected  $guarded = array('id');

    public function intervention(){
        return $this->hasMany('Intervention', 'histology_id', 'id');
    }

}