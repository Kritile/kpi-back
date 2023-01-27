<?php

namespace App\Http\Resources;

use App\Models\Course;
use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $course = Course::where('id', '=', $this->course_id)->first();

        $courseCreator = $course->teacher_id;
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'video_url' => $this->video_url,
            'course_id' => $this->course_id,
            'teacher_id' => $courseCreator
        ];
    }
}
