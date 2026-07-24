<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherAssignment extends Model
{
    //

    protected $fillable = [
        'teacher_id',
        'subject_id',
        'semester_id',
        'section'

       
    ];

    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }

     public function subject(){
        return $this->belongsTo(Subject::class);
    }

     public function user(){
        return $this->belongsTo(User::class);
    }

     public function semester(){
        return $this->belongsTo(Semester::class);
    }

  
}
