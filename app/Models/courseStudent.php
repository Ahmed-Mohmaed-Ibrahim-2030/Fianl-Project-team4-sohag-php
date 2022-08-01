<?php

namespace App\Models;
// use App\Models\courseStudent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class courseStudent extends Model
{
    use HasFactory;
    protected $table ="courses_students";
    protected $fillable=[
        'mark',
        'status',
        'student_id',
        'course_id'
    ];

}
