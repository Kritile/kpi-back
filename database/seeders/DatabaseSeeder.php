<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = \App\Models\User::factory(20)->create();
        $courses = \App\Models\Course::factory(35)->create();

        $lessons = \App\Models\Lesson::factory(130)->create();

        foreach ($users as $user){
            $user->courses()->attach($courses->random(3)->pluck('id'));
        }
    }
}
