<?php

namespace App\Services;

use App\Http\Resources\CourseCollection;
use App\Http\Resources\CourseResource;
use App\Models\Course;

class CourseService
{
    /**
     * @param $page
     * @return CourseCollection
     */
    public function getAllCourses($page){
        return new CourseCollection(Course::orderBy('created_at','desc')->paginate('9',['*'],'',$page));
    }

    /**
     * @param $id
     * @return CourseResource
     */
    public function getCourse($id){
        return new CourseResource(Course::findOrFail($id));
    }

    /**
     * @param $request
     * @return string[]
     */
    public function createCourse($data){

        \Log::info($data);
        $course = new Course();
        $course->fill($data);
        $course->save();
        return ['status'=> 'ok'];
    }
}
