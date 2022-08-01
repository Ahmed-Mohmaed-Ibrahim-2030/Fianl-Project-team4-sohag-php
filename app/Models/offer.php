<?php

namespace App\Models;
// use App\Models\offer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class offer extends Model
{
    use HasFactory;
    protected $table ="offers";
    protected $fillable=[
        'discount_type',
        'discount_value',
        'title',
        'announce_date',
        'start_date',
        'end_date',
        'course_id',
        'admin_id'
    ];
}
