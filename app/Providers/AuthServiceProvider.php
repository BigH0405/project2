<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;


use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use App\Models\admin\Modules;
use App\Policies\ProductPolicy;
use App\Policies\GroupsPolicy;
use App\Policies\UsersPolicy;
use App\Policies\ProductCatePolicy;
use App\Policies\BlogCatePolicy;
use App\Policies\BlogPolicy;
use App\Policies\CommentsPolicy;
use App\Policies\ContacsPolicy;
use App\Policies\CouponsPolicy;
use App\Policies\ReviewsCatePolicy;
use App\Models\admin\Groups;
use App\Models\admin\Users;
use App\Models\admin\Products;
use App\Models\admin\Blog;
use App\Models\admin\BlogCategory;
use App\Models\admin\Comments;
use App\Models\admin\Contacts;
use App\Models\admin\Coupons;
use App\Models\admin\ProductCategory;
use App\Models\admin\Reviews;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Products::class => ProductPolicy::class,
        Blog::class => BlogPolicy::class,
        BlogCategory::class => BlogCatePolicy::class,
        Comments::class => CommentsPolicy::class,
        Contacts::class => ContacsPolicy::class,
        Coupons::class => CouponsPolicy::class,
        Reviews::class => ReviewsCatePolicy::class,
        Users::class => UsersPolicy::class,
        Groups::class => GroupsPolicy::class,
        ProductCategory::class => ProductCatePolicy::class,
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
                        return isRole($roleArr, $module->name);
                    }
                    return false;
                });

                // Định nghĩa quyền edit cho module
                Gate::define($module->name . '.edit', function (Users $user) use ($module) {
                    $roleJson = $user->Group->permissions;
                    if (!empty($roleJson)) {
                        $roleArr = json_decode($roleJson, true);
                        return isRole($roleArr, $module->name, 'edit');
                    }
                    return false;
                });
            }
            }
        }
    }

