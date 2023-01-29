<?php

namespace Tests\Feature;

use App\Facades\CourseServiceFacade;
use App\Models\Course;
use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CourseTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_all_course()
    {
        $response = $this->get('/api/courses/page/1');
        $data = CourseServiceFacade::getAllCourses(1);
        $response->assertStatus(200);
        $response->assertJsonPath('data.data', $data['data']);
    }

    public function test_get_single_course()
    {
        $response = $this->get('/api/courses/1');
        $data = CourseServiceFacade::getCourse(1);
        $response->assertJson(fn(AssertableJson $json) => $json->where('data.id', $data['id'])
            ->where('data.name', $data['name'])
        );

    }

    public function test_get_single_course_with_invalid_id()
    {
        $response = $this->get('/api/courses/10000');
        $response->assertStatus(404);
    }

    public function test_create_course()
    {
        $courseName = fake()->name();
        $courseDesc = fake()->text(200);
        $user = User::where('email','=','admin@admin.com')->first();
        $response = $this->actingAs($user)->post('/api/courses/create',[
            'name' => $courseName,
            'image' => 'http://placekitten.com/g/1200/600',
            'description' => $courseDesc,
            'teacher_id' => $user->id
        ]);
        $response->assertStatus(200);
        $course = Course::findOrFail(json_decode($response->content())->id);
        $this->assertEquals($courseName,$course->name);
        $course->delete();

    }

    public function test_create_course_without_login()
    {
        $courseName = fake()->name;
        $courseDesc = fake()->text(200);
        $response = $this->post('/api/courses/create',[
            'name' => $courseName,
            'image' => 'http://placekitten.com/g/1200/600',
            'description' => $courseDesc,

        ]);
        $response->assertStatus(302);

    }
}
