<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    use HasFactory;

    protected $table='categories';
    protected $fillable=[
        'name',
'image',
        'status',
        'slug',



    ];
    public function subcategory()
    {
        return $this->hasMany(\App\Models\Sub_Category::class, 'category_id');
    }

//    public function parent()
//    {
//        return $this->belongsTo(\App\Models\Category::class, 'parent_id');
//    }


    protected $guarded=['id'];
    public function courses(){
        return $this->hasMany('App\Models\Course');
    }

    // protected $table='categories';
    // protected $fillable=[
//         'name',
// <<<<<<< HEAD
//         // 'status'و
// =======

// >>>>>>> 3fa8191129ac3fba88ff40389ca023db7de4b120
//         'status',
//         'slug',
//         'parent_id'
// <<<<<<< HEAD
// =======


// >>>>>>> 3fa8191129ac3fba88ff40389ca023db7de4b120
//     ];
//     public function subcategory()
//     {
//         return $this->hasMany(\App\Models\Category::class, 'parent_id');
//     }

//     public function parent()
//     {
//         return $this->belongsTo(\App\Models\Category::class, 'parent_id');
//     }

}
