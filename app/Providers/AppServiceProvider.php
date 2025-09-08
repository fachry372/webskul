<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

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
    // public function boot(): void
    // {
    //     ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
    //         return config('app.frontend_url')."/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
    //     });
    // }

    public function boot(): void
    {
        // Share statistik ke semua view
        View::composer('*', function ($view) {
            $hariIni = DB::table('pengunjung')->whereDate('created_at', today())->count();
            $totalPengunjung = DB::table('pengunjung')->count();
            $totalHalaman = DB::table('page_views')->count();

            $view->with([
                'hariIni' => $hariIni,
                'totalPengunjung' => $totalPengunjung,
                'totalHalaman' => $totalHalaman,
            ]);
        });
    }
}
