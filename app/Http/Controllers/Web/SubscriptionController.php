<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubscriptionController extends Controller
{
    public function index()
    {
        $plans = DB::table('plans')->whereNull('deleted_at')->get();
        return view('website.pricing.index', [
            'plans' => $plans,
        ]);
    }

//    public function checkout()
//    {
//        $plans = DB::table('plans')->whereNull('deleted_at')->get();
//        return view('website.pricing.checkout', [
//            'plans' => $plans
//        ]);
//    }

    public function subscribe()
    {
        $plans = DB::table('plans')->whereNull('deleted_at')->get();
        return view('website.pricing.index', [
            'plans' => $plans
        ]);
    }

    public function paymentSuccess(Request $request)
    {
        return redirect('dashboard')->with('success', 'Subscription successful!');
    }

    public function cancelSubscription(Request $request)
    {
        $user = $request->user();
        // Cancel the user's subscription
        $user->subscription('default')->cancel();

        return redirect('/dashboard')->with('success', 'Subscription canceled.');
    }
}
