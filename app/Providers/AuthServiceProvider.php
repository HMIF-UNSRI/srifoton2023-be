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
            $spaUrl = env('FRONTEND_URL') . 'verify-email/?email_verify_url=' . $url;

            return (new MailMessage)
                ->subject('Verify Email Address')
                ->line('Click the button below to verify your email address')
                ->action('Verify Email Address', $spaUrl);
        });
        Gate::define('inti', function (Admin $admin) {
            return $admin->role == 'inti';
        });
        Gate::define('competitive_programming', function (Admin $admin) {
            return $admin->role == 'competitive_programming' || $admin->role == 'competition' || $admin->role == 'inti';
        });
        Gate::define('uiux_design', function (Admin $admin) {
            return $admin->role == 'uiux_design' || $admin->role == 'competition' || $admin->role == 'inti';
        });
        Gate::define('web_development', function (Admin $admin) {
            return $admin->role == 'web_development' || $admin->role == 'competition' || $admin->role == 'inti';
        });
        Gate::define('mobile_legends', function (Admin $admin) {
            return $admin->role == 'mobile_legends' || $admin->role == 'competition' || $admin->role == 'inti';
        });
        Gate::define('seminar', function (Admin $admin) {
            return $admin->role == 'seminar' || $admin->role == 'inti' ;
        });
    }
}