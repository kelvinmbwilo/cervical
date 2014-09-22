<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class ServerUser extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';
    protected $connection = 'mysql2';
    protected  $guarded = array('id');

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

    public function logs(){
        return $this::hasMany("ServerLogs","user_id","id");
    }

    public function getregion(){
        return $this->belongsTo('ServerRegion', 'region', 'id');
    }

    public function getdistrict(){
        return $this->belongsTo('ServerDistrict', 'district', 'id');
    }

    public function getfacility(){
        return $this->belongsTo('ServerFacility', 'facility', 'id');
    }

}
