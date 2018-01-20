<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table='attendances';
    protected $guarded =[];

    protected $dates = [
        'created_at',
        'updated_at',
        'date'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }


}
