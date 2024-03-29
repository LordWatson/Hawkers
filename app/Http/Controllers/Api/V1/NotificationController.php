<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Repository\Classes\ClassesInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function __construct()
    {
        //
    }

    public function all()
    {
        return Auth::user()->notifications;
    }

    public function unread()
    {
        return Auth::user()->unreadNotifications;
    }

    public function destroy($id)
    {
        $notification = Notification::find($id)->delete();

        if($notification == 1){
            return response([
                'message' => 'Notification deleted successfully',
            ], 201);
        }

        return $notification;
    }

    public function markAsRead($id)
    {
        // Effectively a soft delete on a Notification
        // When read_at !null, it will not be returned in an unread get request
        $notification = Notification::find($id);
        $notification->read_at = date('Y-m-d H:i:s');

        return $notification->update();
    }

    public function markAllAsRead()
    {
        // Get only IDs from unread notifications
        $notifications = Auth::user()->unreadNotifications->pluck('id');

        // Mark each notification as read
        foreach($notifications as $notificaiton){
            $notification = Notification::find($notificaiton);
            $notification->read_at = date('Y-m-d H:i:s');
            $notification->update();
        }

        $response = [
            'message' => 'Marked all notifications as read',
        ];

        return response($response, 200);
    }
}
