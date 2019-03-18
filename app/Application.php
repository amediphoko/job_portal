<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    //Table Name
    protected $table = 'applications';
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

    public function job(){
        return $this->belongsTo('App\Job');
    }
}
