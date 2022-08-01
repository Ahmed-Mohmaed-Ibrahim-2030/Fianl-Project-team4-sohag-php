<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam_Content extends Model
{
    use HasFactory;
    protected $table="exam_content";
    protected $fillable=[
        'exam_content_id',
        'question_source',
        'exam_type',
        'exam_id',
    ];
}
