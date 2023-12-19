<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::guard('web')->user();
        return view('website.dashboard.dashboard', [
            'user' => $user
        ]);
    }

    public function profile()
    {
        $user = Auth::guard('web')->user();
        return view('website.profile.profile', [
            'user' => $user
        ]);
    }
}
