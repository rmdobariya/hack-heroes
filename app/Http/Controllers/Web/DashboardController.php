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

    public function done($child_id,$id)
    {
        $user = Auth::guard('web')->user();
        $score = DB::table('dashboard_score')->where('user_id', $user->id)->where('child_id', $child_id)->first();
        DB::table('dashboard_score')->where('user_id', $user->id)->where('child_id', $child_id)->update([
            'unique_risk_profile' => $score->unique_risk_profile + 1
        ]);
        DB::table('recommendation_score')->insert([
            'recommendation_id' => $id,
            'child_id' => $child_id,
        ]);
        return redirect(route('dashboard'));
    }
}
