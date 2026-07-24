<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    //

     protected $fillable = [
        'user_id',
        'department_id',
        'employee_id',
        'status'
       
        
       
    ];

    public function user() {
    return $this->belongsTo(User::class, 'user_id');
}

  
}
