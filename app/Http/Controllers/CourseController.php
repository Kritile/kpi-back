<?php

namespace App\Http\Controllers;

use App\Facades\CourseServiceFacade;
use Illuminate\Http\Request;


class CourseController extends Controller
{
    /**
     * @OA\Get (
     *     path="/api/courses/page/{page}",
     *     tags={"Courses"},
     *      summary="Get course list",
     *
     *     @OA\Parameter(
     *          name="page",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="number",
     *              example="1"
     *          )
     *      ),

     *     @OA\Response(response="200", description="Course list")
     * )
     */
    public function getAllCourse($page)
    {
        return CourseServiceFacade::getAllCourses($page);

    }
    /**
     * @OA\Get (
     *     path="/api/courses/{id}",
     *     tags={"Courses"},
     *      summary="Get course by id",
     *
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="number",
     *              example="4"
     *          )
     *      ),

     *     @OA\Response(response="200", description="Course")
     * )
     */
    public function getCourse($id)
    {
       return CourseServiceFacade::getCourse($id);
    }
    /**
     * @OA\Post (
     *     path="/api/courses/create",
     *     tags={"Courses"},
     *     summary="Create course",
     *     security={ {"bearerAuth": {} }},
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  type="object",
     *                  @OA\Property(
     *                      property="name",
     *                      type="string",
     *                      example="Name",
     *                  ),
     *                  @OA\Property(
     *                      property="image",
     *                      type="string",
     *                      example="http://placekitten.com/g/200/300",
     *                  ),
     *                  @OA\Property(
     *                      property="description",
     *                      type="string",
     *                      example="password",
     *                  ),
     *                  @OA\Property(
     *                      property="fullText",
     *                      type="string",
     *                      example="password",
     *                  ),
     *                  @OA\Property(
     *                      property="teacher_id",
     *                      type="number",
     *                      example="1",
     *                  ),
     *              ),
     *          ),
     *     ),

     *     @OA\Response(response="200", description="status"),
     *     @OA\Response(response="401", description="unauthorized")
     * )
     */
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
