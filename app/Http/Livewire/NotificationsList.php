<?php

namespace App\Http\Livewire;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use MongoDB\Driver\Session;

// Doesn't make sense to use a Repository pattern for notifications since they are created using the facade and this is the only place they are interacted with
class NotificationsList extends Component
{
    public function render()
    {
        $notifs = Auth::user()->notifications;

        return view('livewire.notifications-list')
            ->with('notifs', $notifs);
    }

    public function markAsRead($id)
    {
        $not = Notification::find($id);
        $not->read_at = date('Y-m-d H:i:s');
        $not->update();
    }

    public function markAsUnread($id)
    {
        $not = Notification::find($id);
        $not->read_at = null;
        $not->update();
    }

    public function markAllAsRead()
    {
        $allUnread = Auth::user()->unreadNotifications;
        foreach($allUnread as $not){
            $not->read_at = date('Y-m-d H:i:s');
            $not->update();
        }
    }
}
