<?php

namespace App\Models;
// use App\Models\courseStudent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class courseStudent extends Model
{
    use HasFactory;
    protected $table ="courses_student";
    protected $fillable=[
        'mark',
        'status',
        'student_id',
        'course_id'
    ];
public function student(){
    return $this->belongsTo('App\Models\Student','student_id');
}
public function course(){
    return $this->belongsTo('App\Models\Course','course_id');
    }
}
