<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentModel extends Model
{
    use HasFactory;
    protected $table='parents';
    protected $fillable = [



        'phone',
        'account_id'

    ];
//    public function supports(){
//        return $this->hasMany('instructors_support','instructor_id');
//    }
    public function account(){
        return $this->belongsTo(User::class,'account_id');
    }
//    public function students(){
//        return $this->hasMany(Student::class,'student_id');
//    }

}
