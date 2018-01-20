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
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function permissions(){
        return $this->belongsToMany('App\Permission')->withPivot('user_id','permission_id');
    }

    public function hasPermission($permission){
        return $this->permissions->contains($permission);
    }

    public function leaves(){
        return $this->hasMany('App\Attendance');
    }


}