<?php

namespace App;

use App\Filters\JobFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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

    public function scopeFilter(Builder $builder, $request)
    {
        return (new JobFilter($request))->filter($builder);
    }
}
