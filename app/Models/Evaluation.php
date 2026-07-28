<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    //

    protected $fillable = [

        'student_id',
        'teacher_id',
        'subject_id',
        'semester_id',
        'is_anonymous',
        'overall_rating'
       
    ];
}
