<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor_support extends Model
{
    use HasFactory;
    protected $fillable=[
        'support',
        'instructor_id',
        'admin_id'
    ];
}
