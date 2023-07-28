<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
    ];
    public function courses(){
        return $this->hasMany(Course::class); //one to many relationship with courses table.
    }
}
