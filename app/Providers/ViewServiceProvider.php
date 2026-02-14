<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Notification;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Share unread counts with all vendor views
        View::composer('vendor.*', function ($view) {
            if (Auth::check() && Auth::user()->role === 'vendor') {
                $unreadNotificationsCount = Notification::where('user_id', Auth::id())
                    ->where('is_read', false)
                    ->count();
                
                $unreadMessagesCount = Message::where('receiver_id', Auth::id())
                    ->where('is_read', false)
                    ->count();
                
                $view->with([
                    'unreadNotificationsCount' => $unreadNotificationsCount,
                    'unreadMessagesCount' => $unreadMessagesCount
                ]);
            } else {
                $view->with([
                    'unreadNotificationsCount' => 0,
                    'unreadMessagesCount' => 0
                ]);
            }
        });
    }

    public function register()
    {
        //
    }
}