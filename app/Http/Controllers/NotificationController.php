<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use App\Models\User;
use App\Services\NotificationService;

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
    )
    {
        $service->markAsRead(
            Auth::user(),
            $notificationId
        );

        return redirect()
            ->route('notifications.index')
            ->with('success', '通知を既読にしました。');
    }
}