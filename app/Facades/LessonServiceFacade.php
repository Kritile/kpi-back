<?php

namespace App\Facades;

use App\Services\LessonService;
use Illuminate\Support\Facades\Facade;
use phpDocumentor\Reflection\Types\Integer;

/**
 *
 * @method static getLessonsByCourseId(Integer $id) get lesson by id
 * @method static createLesson(mixed $data, Integer $course_id) create new lesson
 * @method static editLesson(mixed $data, Integer $course_id) edit lesson
 * @method static deleteLesson(Integer $id) remove lesson
 * @see LessonService
 */
class LessonServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return LessonService::class;
    }
}
