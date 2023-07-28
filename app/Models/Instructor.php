<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'gender',
        'salary',
        'status',
        'course_id'
    ];

    public function course(){
        return $this->belongsTo(Course::class);
    }
}
