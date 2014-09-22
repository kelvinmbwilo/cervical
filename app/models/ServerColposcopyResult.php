<?php
/**
 * Created by PhpStorm.
 * User: kelvin
 * Date: 2/17/14
 * Time: 9:04 PM
 */
class ServerColposcopyResult extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'colposcopy_result';
    protected $connection = 'mysql2';
    protected  $guarded = array('id');

    public function colposcop(){
        return $this->hasMany('ServerColposcopyStatus', 'result_id', 'id');
    }


}