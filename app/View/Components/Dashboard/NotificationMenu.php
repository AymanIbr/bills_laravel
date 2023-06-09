<?php

namespace App\View\Components\Dashboard;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class NotificationMenu extends Component
{
    public $notifications;
    public $newCount ;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($count = 10)
    {
        // اشعار للمستخدم المسجل دخول
        $user = Auth::user();
        $this->notifications = $user->notifications()->take($count)->get();
        // ارجاع عدد الرسائل الغير مقروئة
        $this->newCount = $user->unreadNotifications()->count();

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard.notification-menu');
    }
}
