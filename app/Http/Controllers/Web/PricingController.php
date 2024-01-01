<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Stripe;

class PricingController extends Controller
{
    public function index()
    {
        $plans = DB::table('plans')->whereNull('deleted_at')->get();
        return view('website.pricing.index', [
            'plans' => $plans,
        ]);
    }

    public function checkout()
    {
        $plans = DB::table('plans')->whereNull('deleted_at')->get();
        return view('website.pricing.checkout', [
            'plans' => $plans
        ]);
    }

    public function session(Request $request)
    {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $plan = $request->get('title');
        $totalprice = $request->get('total');
        $two0 = "00";
        $total = "$totalprice$two0";

        $session = \Stripe\Checkout\Session::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'USD',
                        'product_data' => [
                            "name" => $plan,
                        ],
                        'unit_amount' => $total,
                    ],
                    'quantity' => 1,
                ],

            ],
            'mode' => 'payment',
            'success_url' => route('success'),
            'cancel_url' => route('checkout'),
        ]);

        return redirect()->away($session->url);
    }

    public function success(Request $request)
    {
        return "Thanks for your order! You have just completed your payment. The seller will reach out to you as soon as possible.";
    }
}
