<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $guarded=['id'];

     protected $fillable=[
         'name',
         'price',
         'small_desc',
        'description',
         'image',
         'sub_category_id',
         'instructor_id',
         'reviewed',

     ];
     public function sub_category()
     {
         return $this->belongsTo('App\Models\Sub_Category','sub_category_id');
     }
     public function instructor()
     {
         return $this->belongsTo('App\Models\Instructor','instructor_id');
     }
     public function accepted_by()
     {
         return $this->belongsTo('App\Models\Admin','accepted_by');
     }
     public function rates(){
         return $this->hasMany(Course_Rate::class,'course_id');
     }
       public function avrageRate(){
         return $this->hasMany(Course_Rate::class,'courseId')->avg('rate')->get();
     }
  public function students(){
         return $this->hasMany(courseStudent::class,'course_id');
     }
     public function courseContent(){
         return $this->hasMany(courseContent::class,'course_id');

     }

}
