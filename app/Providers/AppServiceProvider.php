<?php

namespace App\Providers;

use App\Http\Livewire\StudentData;
use App\Models\User;
use Livewire\Livewire;
use App\Http\Livewire\ViewForm;
use App\Models\ScholarshipName;
use App\Models\ScholarshipType;
use App\Http\Livewire\AddScholar;
use App\Observers\AuditLogObserver;
use Illuminate\Support\ServiceProvider;

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
    public function boot()
    {
        ScholarshipType::observe(AuditLogObserver::class);
        ScholarshipName::observe(AuditLogObserver::class);
        User::observe(AuditLogObserver::class);

        Livewire::component('addScholar', AddScholar::class);
        Livewire::component('student-data', StudentData::class);
    }

}
