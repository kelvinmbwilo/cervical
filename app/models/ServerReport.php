<?php

class ServerReport extends Eloquent {

    protected $table = 'reports';
    protected $connection = 'mysql2';
    protected  $guarded = array('id');

}
