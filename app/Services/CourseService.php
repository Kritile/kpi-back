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
        $course_list = new CourseCollection(Course::orderBy('created_at','desc')->paginate('9',['*'],'',$page));
        return $course_list;
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

        $course = new Course();
        $course->fill($data);
        $course->save();
        return ['status'=> 'ok', 'id' => $course->id];
    }
}
