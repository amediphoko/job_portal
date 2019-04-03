<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inbox extends Model
{
    //Table Name
    protected $table = 'inbox';
    //Primary Key
    public $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function employer(){
        return $this->belongsTo('App\Employer');
    }
}