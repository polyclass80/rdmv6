<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public function users(){
        return $this->belongsToMany('App\User')->withPivot('user_id','permission_id');
    }

}
