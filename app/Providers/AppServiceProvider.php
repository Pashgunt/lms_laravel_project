<?php

namespace App\Providers;

use App\LMS\Repositories\ActivityRepository;
use App\LMS\Repositories\CourseRepository;
use App\LMS\Repositories\UserRepository;
use App\Models\Activities;
use App\Models\Courses;
use App\Models\User;
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
        if ($this->app->isLocal()) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

        $this->app->singleton(UserRepository::class, function ($app) {
            return new UserRepository(new User());
        });

        $this->app->singleton(CourseRepository::class, function ($app) {
            return new CourseRepository(new Courses());
        });

        $this->app->singleton(ActivityRepository::class, function ($app) {
            return new ActivityRepository(new Activities());
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
