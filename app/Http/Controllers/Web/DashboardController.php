<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::guard('web')->user();
        $user_childrens = DB::table('user_childrens')->where('user_id', $user->id)->get();
        return view('website.dashboard.dashboard', [
            'user' => $user,
            'user_childrens' => $user_childrens,
        ]);
    }
}
