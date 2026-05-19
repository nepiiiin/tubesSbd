<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Gate;
use App\Models\Category;
use App\Models\Job;
use App\Models\Application;
use App\Policies\JobPolicy;
use App\Policies\ApplicationPolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share categories ke semua view (untuk sidebar/menu)
        View::share('categories', Category::all());
        
        // Use Bootstrap pagination style
        Paginator::useBootstrap();

        Gate::policy(Job::class, JobPolicy::class);
        Gate::policy(Application::class, ApplicationPolicy::class);
    }
}