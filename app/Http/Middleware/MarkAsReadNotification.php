<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MarkAsReadNotification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $notifications_id = $request->query('notifications_id');
        if ($notifications_id) {
            $user = $request->user();
            if ($user) {
                $notification = $user->unreadNotifications()->find($notifications_id);
                if ($notification)
                    $notification->markAsRead();
            }
        }
        return $next($request);
    }
}
