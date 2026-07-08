<?php

namespace App\Providers;

use App\Modules\Department\Interfaces\DepartmentRepositoryInterface;
use App\Modules\Department\Repositories\DepartmentRepository;
use App\Modules\Department\Services\DepartmentService;
use App\Modules\Doctor\Interfaces\DoctorRepositoryInterface;
use App\Modules\Doctor\Repositories\DoctorRepository;
use App\Services\CategoryService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CategoryService::class, function ($app) {
            return new CategoryService();
        });
        $this->app->bind(DepartmentRepositoryInterface::class, DepartmentRepository::class);
        $this->app->bind(DoctorRepositoryInterface::class, DoctorRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
