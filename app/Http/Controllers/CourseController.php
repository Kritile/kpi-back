<?php

namespace App\Http\Controllers;

use App\Http\Resources\CourseCollection;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{
    public function getAllCourse(Request $request, $page)
    {

        return new CourseCollection(Course::orderBy('created_at','desc')->paginate('9',['*'],'',$page));
    }
    public function getCourse(Request $request,$id)
    {
        return new CourseResource(Course::find($id));
    }

    public function createCourse(Request $request){
        $data = $request->validate([
            'name' => ['required'],
            'imageUrl' => ['required'],
            'desc' => ['required'],
            'fullText' => [],
        ]);
        $course = new Course();
        $course->name = $data['name'];
        $course->image = $data['imageUrl'];
        $course->description = $data['desc'];
        $course->teacher_id = auth('sanctum')->id();
        $course->fullText = $data['fullText'];
        $course->save();
        return ['status'=> 'ok'];
    }

}
