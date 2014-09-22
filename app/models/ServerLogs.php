<?php
/**
 * Created by PhpStorm.
 * User: kelvin
 * Date: 2/17/14
 * Time: 9:04 PM
 */
class ServerLogs extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'logs';
    protected $connection = 'mysql2';
    protected  $guarded = array('id');

    public function user(){
        return $this->belongsTo('ServerUser', 'user_id', 'id');
    }

}