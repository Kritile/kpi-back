<?php

namespace App\Providers;

use App\Services\CourseService;
use App\Services\LessonService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;
use L5Swagger\L5SwaggerServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(L5SwaggerServiceProvider::class);
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
