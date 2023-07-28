<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=>$this->id,
            "title"=>$this->title,
            "description"=>$this->description,
            "num_of_hours"=>$this->num_of_hours,
            "price"=>$this->price,
            "created_at"=>$this->created_at,
            "updated_at"=>$this->updated_at,
            "category"=>$this->category,
            "instructors"=>$this->instructors,
            "quizes"=>$this->quizes,
            "videos"=>$this->videos,
            "comments"=>$this->comments,
            "users"=>$this->users,
        ];
    }
    
}
