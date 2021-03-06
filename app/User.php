<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'last_name', 'dob', 'gender', 'pro_pic', 'contacts', 'residence', 'qualification', 'documents', 'cover_letter'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function applications() {
        return $this->hasMany('App\Application');
    }

    public function inbox() {
        return $this->hasMany('App\Inbox');
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }
}
