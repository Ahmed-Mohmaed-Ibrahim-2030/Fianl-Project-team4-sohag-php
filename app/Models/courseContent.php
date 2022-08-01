<?php

namespace App\Models;
//use App\Models\courseContent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class courseContent extends Model
{
    use HasFactory;
    protected $table ="courses_content";
    protected $fillable=[
        'content_type',
        'source',
        'course_id'
    ];
}
