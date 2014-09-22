<?php

class ServerDashboard extends Eloquent {

    protected $table = 'dashboard';
    protected $connection = 'mysql2';
    protected  $guarded = array('id');

}