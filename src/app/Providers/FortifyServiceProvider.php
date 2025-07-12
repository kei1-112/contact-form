<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use App\Http\Requests\AdminRequest;
use App\Actions\CreateAdminUser;

class FortifyServiceProvider extends ServiceProvider
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
        //開発用
        RateLimiter::for('login', function (Request $request){
            return Limit::none();
        });

        Fortify::createUsersUsing(CreateAdminUser::class);
        
        Fortify::registerView(function (){
            return view('register');
        });

        Fortify::loginView(function (){
            return view('login');
        });
    }
}
