<?php

namespace App;

use App\Filters\InboxFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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

    public function scopeFilter(Builder $builder, $request)
    {
        return (new InboxFilter($request))->filter($builder);
    }
}