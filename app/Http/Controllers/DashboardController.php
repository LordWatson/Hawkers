<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct(){
        //
    }

    public function index(Request $request)
    {
        $title = Auth::user()->isAdmin() ? 'User Dashboard' : 'Dashboard';

        return view('pages.dashboard')
            ->with('title', $title);
    }
}
