<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin_Course extends Model
{

    use HasFactory;
    protected $table='admin_course';
    protected $fillable=[
        'admin_id',
'course_id'
];
}
