<?php

namespace App\Providers;

use App\Models\User;
use App\Support\SmtpConfiguration;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(SmtpConfiguration::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(SmtpConfiguration $smtpConfiguration): void
    {
        Model::preventLazyLoading(! app()->isProduction());

        Gate::define('access-admin', fn (User $user): bool => $user->is_admin);

        $smtpConfiguration->applyFromDatabase();
    }
}
