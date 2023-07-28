<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'num_of_hours',
        'price',
        'category_id'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function quizes() {
        return $this->hasMany(Quiz::class); //one to many relationship with courses table.
    }

    public function videos() {
        return $this->hasMany(Video::class); //one to many relationship with courses table.
    }
    public function instructors(){
        return $this->hasMany(Instructor::class);
    }

    public function answers(){
        return $this->hasMany(Answer::class);
    }

    public function users(){
        return $this->belongsToMany(User::class , 'course_user');
    }

    public function comments() {
        return $this->hasMany(Comment::class); //one to many relationship with courses table.
    }
}
