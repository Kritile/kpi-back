<?php

namespace App\Http\Controllers;

use App\Facades\LessonServiceFacade;
use App\Services\LessonService;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * @OA\Get (
     *     path="/api/courses/{course_id}/lessons",
     *     tags={"Lesson"},
     *     summary="Get lessons by course id",
     *     security={ {"bearerAuth": {} }},
     *
    *      @OA\Parameter(
     *          name="course_id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="number",
     *              example="4"
     *          )
     *      ),
     *     @OA\Response(response="200", description="status"),
     *
     * )
     */
    public function getLessonsList($course_id){
        return LessonServiceFacade::getLessonsByCourseId($course_id);

    }
    /**
     * @OA\Post (
     *     path="/api/courses/{course_id}/lessons",
     *     tags={"Courses"},
     *     summary="Create course",
     *     security={ {"bearerAuth": {} }},
     *      @OA\Parameter(
     *          name="course_id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="number",
     *              example="4"
     *          )
     *      ),
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
     *                      property="imageUrl",
     *                      type="string",
     *                      example="http://placekitten.com/g/200/300",
     *                  ),
     *                  @OA\Property(
     *                      property="fullText",
     *                      type="string",
     *                      example="password",
     *                  ),
     *
     *              ),
     *          ),
     *     ),

     *     @OA\Response(response="200", description="status"),
     *     @OA\Response(response="401", description="unauthorized")
     * )
     */
    public function createLesson(Request $request, $course_id){
        $data = $request->validate([
            'name' => ['required'],
            'imageUrl' => [],
            'fullText' => [],
        ]);
        return LessonServiceFacade::createLesson($data,$course_id);
    }
    /**
     * @OA\Put (
     *     path="/api/courses/{course_id}/lessons",
     *     tags={"Lesson"},
     *     summary="Edit lesson course",
     *     security={ {"bearerAuth": {} }},
     *      @OA\Parameter(
     *          name="course_id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="number",
     *              example="4"
     *          )
     *      ),
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
     *                      property="imageUrl",
     *                      type="string",
     *                      example="http://placekitten.com/g/200/300",
     *                  ),
     *                  @OA\Property(
     *                      property="fullText",
     *                      type="string",
     *                      example="password",
     *                  ),
     *                  @OA\Property(
     *                      property="lessonId",
     *                      type="number",
     *                      example="2",
     *                  ),
     *
     *              ),
     *          ),
     *     ),

     *     @OA\Response(response="200", description="status"),
     *     @OA\Response(response="401", description="unauthorized")
     * )
     */
    public function editLesson(Request $request, $course_id){
        $data = $request->validate([
            'name' => ['required'],
            'imageUrl' => [],
            'fullText' => [],
            'lessonId' => ['required']

        ]);
       return LessonServiceFacade::editLesson($data,$course_id);
    }
    /**
     * @OA\Delete (
     *     path="/api/courses/lesson/{id}",
     *     tags={"Lesson"},
     *     summary="Delete lesson",
     *     security={ {"bearerAuth": {} }},
     *
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="number",
     *              example="4"
     *          )
     *      ),
     *     @OA\Response(response="200", description="status"),
     *
     * )
     */
    public function removeLesson($id){
        return LessonServiceFacade::deleteLesson($id);
    }
}
