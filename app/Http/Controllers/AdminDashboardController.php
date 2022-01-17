<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{

    public function __construct(){
        //
    }

    public function index(Request $request)
    {
        return view('pages.admin-dashboard')
            ->with('title', 'Admin Dashboard');
    }
}
