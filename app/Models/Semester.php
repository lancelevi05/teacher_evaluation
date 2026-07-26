<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    //

     protected $fillable = [
        'academic_year_id',
        'name',
        'status',
       
    ];

    public function academicyear()
{
    return $this->belongsTo(AcademicYear::class, 'academic_year_id');
}
}
