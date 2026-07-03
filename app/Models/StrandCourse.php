<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StrandCourse extends Model
{
     // exact table name
    // protected $table = 'strand_courses';

    // // since NO primary key
    // protected $primaryKey = null;

    // // disable auto increment
    // public $incrementing = false;

    // // your table has no created_at & updated_at
    // public $timestamps = false;

    // allow mass assignment
    protected $fillable = [
        'idstrandcourse',
        'strandcourse',
        'max_section',
        'shs_college'
    ];
}
