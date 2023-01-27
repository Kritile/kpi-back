<?php

namespace App\Facades;

use App\Services\CourseService;
use Illuminate\Support\Facades\Facade;
use Ramsey\Uuid\Type\Integer;

/**
 * @method static getAllCourses(Integer $page) get courses by page number
 * @method static getCourse(Integer $id) get course by id
 * @method static createCourse(mixed $data) create course
 *
 * @see CourseService
 */
class CourseServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CourseService::class;
    }
}

