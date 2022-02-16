<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * @var string
     */
    private $title;

    public function __construct()
    {
        $this->title = 'Notifications';
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(Request $request)
    {
        $sub_title = count(Auth::user()->unreadNotifications);

        $header_buttons = [
            0 => [
                'title' => 'Mark all as read',
                'colour' => 'dark',
                'type' => 'btn',
                'id' => 'markAll',
                'wire_click' => '',
                'onclick' => '',
            ],
        ];

        return view('pages.notifications.list')
            ->with('header_buttons', $header_buttons)
            ->with('title', $this->title)
            ->with('sub_title', $sub_title);
    }
}
