<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course_Rate extends Model
{
    use HasFactory;
    protected $table='courses_rate';
    protected $fillable=[
        'student_id',
        'rate',
        'comment',
'course_id'
    ];
    public function course(){
        $this->belongsTo(Course::class, 'course_id');
    }
//    public function student(){
//        $this->belongsTo(Student::class, 'student-id');
//
//    }
}
