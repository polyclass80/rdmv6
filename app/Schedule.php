<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table='schedules';


    protected $dates = [
        'created_at',
        'schedule_at',
        'due_at'
    ];

    public function inventorys(){
        return $this->belongsToMany('App\Inventory')->withPivot('block_qty')->wherePivot('actual_qty', 0);
    }

    public function user(){
        return $this->belongsTo('App\User');
    }


//    public $timestamps = false;
//    protected $dateFormat = 'U';
//
//    protected function getDateFormat()
//    {
//        return time();
//    }
//
//   protected function asDateTime($value)
//{
//    return $value;
//}
}
