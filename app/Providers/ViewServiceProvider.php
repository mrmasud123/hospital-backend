<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {

        View::composer('layouts.app-header', function($view){
            $notifications = [];
            $unreadCount = 0;
            $user = Auth::user();

            if ($user && ($user->hasRole('admin') || $user->hasRole('super-admin'))) {
                $notifications = $user->notifications()->latest()->get()->toArray();
                $unreadCount = $user->unreadNotifications()->count();
            }

            $view->with('notifications', $notifications);
            $view->with('unreadCount', $unreadCount);
            $view->with('user', $user?->load('roles'));
        });
    }
}
