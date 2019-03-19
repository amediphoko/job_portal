<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    //Table Name
    protected $table = 'jobs';
    //Primary Key
    public $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;

    public function employer(){
        return $this->belongsTo('App\Employer');
    }

    public function applications() {
        return $this->hasMany('App\Application');
    }
}
