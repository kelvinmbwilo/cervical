<?php
/**
 * Created by PhpStorm.
 * User: kelvin
 * Date: 2/17/14
 * Time: 9:04 PM
 */
class ColposcopyResult extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'colposcopy_result';

    protected  $guarded = array('id');

    public function colposcop(){
        return $this->hasMany('ColposcopyStatus', 'result_id', 'id');
    }


}