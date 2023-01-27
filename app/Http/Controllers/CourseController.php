<?php

namespace App\Http\Controllers;

use App\Facades\CourseServiceFacade;
use Illuminate\Http\Request;


class CourseController extends Controller
{
    public function getAllCourse($page)
    {
        return CourseServiceFacade::getAllCourses($page);

    }
    public function getCourse($id)
    {
       return CourseServiceFacade::getCourse($id);
    }

    public function createCourse(Request $request){
        $data = $request->validate([
            'name' => ['required'],
            'image' => ['required'],
            'description' => ['required'],
            'fullText' => [],
            'teacher_id' => []
        ]);
        return CourseServiceFacade::createCourse($data);
    }

}
