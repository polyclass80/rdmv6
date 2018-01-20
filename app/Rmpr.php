<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rmpr extends Model
{

    protected $table='rmprs';
    protected $dateFormat = 'U';

    public function inventorys(){
        return $this->belongsToMany('App\Inventory')->withPivot('pr_qty')->wherePivot('status', 0);
    }

    public $timestamps = false;
}
