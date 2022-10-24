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
        $users = \App\Models\User::factory(10)->create();
        $courses = \App\Models\Course::factory(20)->create();

        $lessons = \App\Models\Lesson::factory(130)->create();

        DB::table('roles')->insert([
            'name' => 'admin',
        ]);
        DB::table('roles')->insert([
            'name' => 'teacher',
        ]);
        DB::table('roles')->insert([
            'name' => 'user',
        ]);

        foreach ($users as $user){
            $user->courses()->attach($courses->random(3)->pluck('id'));
            $user->roles()->attach(Role::all()->random(1)->pluck('id'));
        }
    }
}
