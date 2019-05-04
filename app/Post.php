<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //Table Name
    protected $table = 'posts';
    //Primary Key
    public $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;

    public function employer(){
        return $this->belongsTo('App\Employer');
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }
}
