<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Models\Order;

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
    public function boot(Request $request)
    {
        // Cek apakah request datang dari ngrok atau memiliki header secure dari tunnel
        if (str_contains($request->getHost(), 'ngrok-free.dev') || $request->header('X-Forwarded-Proto') === 'https') {
            URL::forceRootUrl(config('app.url'));
            URL::forceScheme('https');
        }

        View::composer('*', function ($view) {
            $pendingOrders = Order::where('status', 'pending')->count();
            $view->with('pendingOrders', $pendingOrders);
        });
    }
}
