<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laratrust\Traits\LaratrustUserTrait;

class Admin extends Model
{
    use LaratrustUserTrait;
    use HasFactory;
    protected $fillable = [

        'phone',
         'account_id'
    ];
public function instructors_supported(){
    return $this->hasMany(Instructor_support::class);
}
//public function students_supported(){
//    return $this->hasMany(Student_support::class);
//}
public function accepted_courses(){
    return $this->hasMany(Course::class,'accepted_by');
}
public function account(){
    return $this->belongsTo(User::class,'account_id');
}
//public function offers(){
//    return $this->hasMany(Offer::class, 'offer_id');
//}

}
