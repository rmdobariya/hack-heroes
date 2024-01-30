<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::guard('web')->user();
        $user_childrens = DB::table('user_childrens')->where('user_id', $user->id)->get();
        $payment_failure = '';
        if(!empty(Session::get('payment-failure'))) {
            $payment_failure = Session::get('payment-failure');
            Session::forget('payment-failure');
        }
        $payment_success = '';
        if(!empty(Session::get('payment-success'))) {
            $payment_success = Session::get('payment-success');
            Session::forget('payment-success');
        }
        return view('website.dashboard.dashboard', [
            'user' => $user,
            'user_childrens' => $user_childrens,
            'payment_failure' => $payment_failure,
            'payment_success' => $payment_success,
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
