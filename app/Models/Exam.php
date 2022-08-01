<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    protected $table="exam";
    protected $fillable=[
        'exam_id',
        'announce_date',
        'start_date',
        'hours',
        'mark',
        'course_id'
    ];
}
