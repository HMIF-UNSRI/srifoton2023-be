<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        VerifyEmail::toMailUsing(function ($notifable, $url) {
            $spaUrl = env('FRONTEND_URL') . '?email_verify_url=' . $url;

            return (new MailMessage)
                ->subject('Verify Email Address')
                ->line('Click the button below to verify your email address')
                ->action('Verify Email Address', $spaUrl);
        });
        Gate::define('inti', function (Admin $admin) {
            return $admin->role == 'inti';
        });
        Gate::define('competition', function (Admin $admin) {
            return $admin->role == 'competition';
        });
        Gate::define('competitive_programming', function (Admin $admin) {
            return $admin->role == 'competitive_programming';
        });
        Gate::define('uiux_design', function (Admin $admin) {
            return $admin->role == 'uiux_design';
        });
        Gate::define('web_development', function (Admin $admin) {
            return $admin->role == 'web_development';
        });
        Gate::define('mobile_legends', function (Admin $admin) {
            return $admin->role == 'mobile_legends';
        });
        Gate::define('seminar', function (Admin $admin) {
            return $admin->role == 'seminar';
        });
    }
}