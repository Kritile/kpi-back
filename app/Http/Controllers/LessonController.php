<?php

namespace App\Http\Controllers;

use App\Facades\LessonServiceFacade;
use App\Services\LessonService;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function getLessonsList($course_id){
        return LessonServiceFacade::getLessonsByCourseId($course_id);

    }

    public function createLesson(Request $request, $course_id){
        $data = $request->validate([
            'name' => ['required'],
            'imageUrl' => [],
            'fullText' => [],
        ]);
        return LessonServiceFacade::createLesson($data,$course_id);
    }

    public function editLesson(Request $request, $course_id){
        $data = $request->validate([
            'name' => ['required'],
            'imageUrl' => [],
            'fullText' => [],
            'lessonId' => ['required']

        ]);
       return LessonServiceFacade::editLesson($data,$course_id);
    }

    public function removeLesson($id){
        return LessonServiceFacade::deleteLesson($id);
    }
}
