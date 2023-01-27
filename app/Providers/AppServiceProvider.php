<?php

namespace App\Providers;

use App\Services\CourseService;
use App\Services\LessonService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CourseService::class,function (){
            return new CourseService();
        });
        $this->app->bind(LessonService::class,function (){
            return new LessonService();
        });
        $this->app->bind(UserService::class,function (){
            return new UserService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
