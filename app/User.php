<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

	public $incrementing = false;
	protected $table = 'user_default';
	protected $primaryKey = 'username';
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','username', 'email', 'password', 'profilePath'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function dotadetail()
    {
        return $this->hasOne('App/Dotadetail', 'username', 'username');
    }

    public function overwatchdetail()
    {
        return $this->hasOne('App/Overwatchdetail', 'username', 'username');
    }

    public function friends_list()
    {
        return $this->hasMany('App/Friends_list', 'username', 'username');
    }
}
