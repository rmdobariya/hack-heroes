<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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
        $user = Auth::guard('web')->user();
        $user = User::find($user->id);
        $user->stripe_customer_id = Session::get('customer_id');
        $user->payment_id = Session::get('payment_id');
        $user->plan_id = Session::get('plan_id');
        $user->plan_created_at = date('Y-m-d');
        $user->save();
        Session::forget('customer_id');
        Session::forget('payment_id');
        Session::forget('plan_id');
        Session::put('payment-success', 'Subscription successful');
        return redirect('dashboard')->with('success', 'Subscription successful!');
    }

    public function cancelSubscription(Request $request)
    {
        $user = $request->user();
        // Cancel the user's subscription
        $user->subscription('default')->cancel();

        return redirect('/dashboard')->with('success', 'Subscription canceled.');
    }

    public function paymentError(Request $request)
    {
        Session::put('payment-failure', 'You have cancelled your payment.');
        return redirect('/dashboard')->with('payment-failure', 'You have cancelled your payment.');
    }
}
