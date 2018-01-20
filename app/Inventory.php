<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table='inventorys';
    protected $dateFormat = 'U';

    public function schedules(){
        return $this->belongsToMany('App\Schedule')->withPivot('block_qty')->wherePivot('actual_qty', 0);
    }

    public function rmprs(){
        return $this->belongsToMany('App\Rmpr')->withPivot('pr_qty')->wherePivot('actual_qty', 0);
    }



    public $timestamps = false;
}
