<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\admin\Groups;
use App\Models\admin\Users;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use App\Models\admin\Modules;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Đảm bảo hàm isRole đã được tải
        // require_once base_path('path/to/functions.php');

        ResetPassword::createUrlUsing(function ($user, string $token) {
            if ($user instanceof Users) {
                // Đây là một người dùng admin
                return route('admin.rest-password', ['token' => $token]) . '?email=' . $user->email;
            } else {
                // Đây là một người dùng client
                return route('clients.rest-password', ['token' => $token]) . '?email=' . $user->email;
            }
        });

        $moduleList = Modules::all();
        if ($moduleList->count() > 0) {
            foreach ($moduleList as $module) {
                Gate::define($module->name, function (Users $user) use ($module) {
                    $roleJson = $user->Group->permissions;
                    if (!empty($roleJson)) {
                        $roleArr = json_decode($roleJson, true);
                        return isRole($roleArr, $module->name); // Sử dụng hàm isRole từ file functions
                    }
                    return false;
                });
            }
        }
    }
}
