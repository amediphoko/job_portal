<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\EmployerResetPasswordNotification;

class Employer extends Authenticatable
{
    use Notifiable;

    protected $guard = 'employer';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'industry', 'location', 'contacts', 'logo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function jobs() {
        return $this->hasMany('App\Job');
    }

    public function posts() {
        return $this->hasMany('App\Post');
    }

    public function applications() {
        return $this->hasMany('App\Application');
    }

    public function inbox() {
        return $this->hasMany('App\Inbox');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new EmployerResetPasswordNotification($token));
    }
}
