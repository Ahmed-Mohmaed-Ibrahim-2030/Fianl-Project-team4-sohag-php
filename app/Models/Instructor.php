<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    use HasFactory;

    protected $fillable = [


        'phone',
        'account_id',
        'scientific_degree',
        'description',
'image'
    ];
    public function supports(){
        return $this->hasMany(Instructor_support::class,'instructor_id');
    }
    public function account(){
        return $this->belongsTo(User::class,'account_id');
    }

    protected $guarded=['id'];

    public function courses(){
        return $this->hasMany('App\Course');
    }
//     protected $fillable = [
//         'first_name',
//         'last_name',
//         'email',
//         'address',
//         'phone',
//         'account_id'

//     ];
//     public function supports(){
//         return $this->hasMany(Instructor_support::class,'instructor_id');
//     }
//     public function my_account(){
//         return $this->belongsTo(Account::class,'account_id');
//     }
//     public function courses(){
//         return $this->hasMany(Course::class,'instructor_id');
//     }

}
