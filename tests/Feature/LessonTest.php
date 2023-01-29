<?php

namespace Tests\Feature;

use App\Facades\LessonServiceFacade;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class LessonTest extends TestCase
{
    /**
     * test get lesson by course id
     *
     * @return void
     */
    public function test_get_lesson()
    {
        $courseId = Course::first()->id;
        $response = $this->get('/api/courses/'.$courseId.'/lessons');
        $data = LessonServiceFacade::getLessonsByCourseId($courseId);
        $response->assertStatus(200);
        $response->assertJson(fn(AssertableJson $json) => $json->where('data.0.name', $data[0]['name']));
    }

    public function test_create_lesson()
    {
        $lessonName = fake()->name();
        $course = Course::first();
        $user = $course->users[0];
        $response = $this->actingAs($user)->post('/api/courses/'.$course->id.'/lessons',[
            'name' => $lessonName,
            'imageUrl' => '',
            'fullText' => '',
        ]);
        $lesson = Lesson::findOrFail(json_decode($response->content())->id);
        $response->assertStatus(200);
        $this->assertEquals($lessonName, $lesson->name);
        $lesson->delete();
    }
    public function test_create_lesson_withoutLogin()
    {
        $lessonName = fake()->name();
        $courseId = Course::first()->id;
        $response = $this->post('/api/courses/'.$courseId.'/lessons',[
            'name' => $lessonName,
            'imageUrl' => '',
            'fullText' => '',
        ]);
        $response->assertStatus(302);
    }

    public function test_update_lesson()
    {
        $lessonName = fake()->name();
        $course = Course::first();
        $lesson = $course->lessons[0];
        $user = $course->users[0];
        $response = $this->actingAs($user)->put('/api/courses/'.$course->id.'/lessons',[
            'name' => $lessonName,
            'imageUrl' => '',
            'fullText' => '',
            'lessonId' => $lesson->id,
        ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('lessons',[
            'id' => $lesson->id,
            'name' => $lessonName
        ]);
    }

    public function test_update_lesson_without_login()
    {
        $lessonName = fake()->name();
        $course = Course::first();
        $lesson = $course->lessons[0];
        $response = $this->put('/api/courses/'.$course->id.'/lessons',[
            'name' => $lessonName,
            'imageUrl' => '',
            'fullText' => '',
            'lessonId' => $lesson->id,
        ]);
        $response->assertStatus(302);
    }

    public function test_delete_lesson()
    {
        $course = Course::first();
        $lesson = $course->lessons[0];
        $user = $course->users[0];
        $response = $this->actingAs($user)->delete('/api/courses/lesson/'.$lesson->id);
        $response->assertStatus(200);
        $this->assertDatabaseMissing('lessons',[
            'id' => $lesson->id,
        ]);
    }

    public function test_delete_lesson_without_login()
    {
        $course = Course::first();
        $lesson = $course->lessons[0];
        $response = $this->delete('/api/courses/lesson/'.$lesson->id);
        $response->assertStatus(302);
    }

}
