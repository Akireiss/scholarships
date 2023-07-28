<?php

namespace App\Providers;

use App\Http\Livewire\AddScholar;
use App\Models\User;
use App\Models\ScholarshipName;
use App\Models\ScholarshipType;
use App\Observers\AuditLogObserver;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

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
    }

}
