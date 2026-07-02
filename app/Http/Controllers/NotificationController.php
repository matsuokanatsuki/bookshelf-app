<?php

namespace App\Http\Controllers;

use App\Services\NotificationService;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index(NotificationService $service)
    {
        $notifications = $service->getUserNotifications(Auth::user());

        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead(
        string $notificationId,
        NotificationService $service
    ) {
        $service->markAsRead(
            Auth::user(),
            $notificationId
        );

        return redirect()
            ->route('notifications.index')
            ->with('success', '通知を既読にしました。');
    }
}
