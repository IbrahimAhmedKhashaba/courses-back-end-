<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_id',
        'question',
        'answer',
    ];

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function answers() {
        return $this->hasMany(Answer::class); //one to many relationship with courses table.
    }
}
