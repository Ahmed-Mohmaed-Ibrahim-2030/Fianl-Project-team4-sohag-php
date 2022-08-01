<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_Support extends Model
{
    use HasFactory;
    protected $table="students_support";
    protected $fillable=[
        'support',
        'admin_id',
        'student_id'
    ];

}
