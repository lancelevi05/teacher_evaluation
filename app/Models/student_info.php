<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class student_info extends Model
{
     protected $fillable = [
        'user_id',
        'usn',
        'idstrandcourse',
        'section',
        'shs_college',
        'yglevel'
        
       
    ];
}
