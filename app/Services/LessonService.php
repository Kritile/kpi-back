<?php

namespace App\Services;

use App\Http\Resources\LessonCollection;
use App\Models\Course;
use App\Models\Lesson;

class LessonService
{
    /**
     * @param $id
     * @return LessonCollection
     */
    public function getLessonsByCourseId($course_id){
        return new LessonCollection(Lesson::where('course_id' ,'=',$course_id)->get());
    }

    /**
     * @param \Request $request
     * @param $course_id
     * @return string[] | \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function createLesson($data, $course_id){
        $course = Course::find($course_id);
        if($course){
            $lesson = new Lesson();
            $lesson->fill($data);
            $lesson->course_id = $course_id;
            $lesson->save();
            $course->lessons()->save($lesson);
            return ['status'=> 'ok', 'id'=>$lesson->id];
        }else{
           return response('Course not found',404);
        }


    }

    /**
     * @param $request
     * @param $course_id
     * @return string[]
     */
    public function editLesson($data, $course_id){

        $lesson = Lesson::findOrFail($data['lessonId']);
        $lesson->fill($data);
        $lesson->course_id = $course_id;
        $lesson->save();
        return ['status'=> 'ok', 'id'=> $lesson->id];
    }

    /**
     * @param $id
     * @return string[]
     */
    public function deleteLesson($id){
        $lesson = Lesson::findOrFail($id);
        if($lesson){
            $lesson->delete();
            return ['status'=> 'ok'];
        }else{
            return ['status' => 'lesson_not_found'];
        }
    }
}
