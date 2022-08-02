<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = ['question', 'options', 'answer_number', 'exam_id','value'];
    protected $casts = ['options' => 'array'];

}
