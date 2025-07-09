<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
         // Web + 認証ユーザーに限定したルート設定
        // Broadcast::routes([
        //     'middleware' => ['web', 'auth'], // 'auth:web' と同等
        // ]);

        // require base_path('routes/channels.php');
    }
}
