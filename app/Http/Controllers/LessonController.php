<?php

namespace App\Http\Controllers;

use App\Http\Resources\LessonCollection;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function getLessonsList(Request $request,$course_id){
        return new LessonCollection(Lesson::where('course_id' ,'=',$course_id)->get());
    }

    public function createLesson(Request $request){
        $data = $request->validate([
            'name' => ['required'],
            'imageUrl' => [],
            'fullText' => [],
            'courseId' => ['required'],
            'lessonId' => []
        ]);
        $lesson = isset($data['lessonId']) && $data['lessonId'] ?
            Lesson::where('id', '=', $data['lessonId'])->first() :
            new Lesson();

        $lesson->description = $data['fullText'];
        $lesson->name = $data['name'];
        $lesson->video_url = $data['imageUrl'];
        $lesson->course_id = $data['courseId'];
        $lesson->save();
        return ['status'=> 'ok'];

    }

    public function removeLesson(Request $request){
        $data = $request->validate([
            'id' => ['required'],
        ]);
        $lesson = Lesson::where('id', '=', $data['id']);
        if($lesson){
            $lesson->delete();
            return ['status'=> 'ok'];
        }else{
            return ['status' => 'lesson_not_found'];
        }
    }
}
