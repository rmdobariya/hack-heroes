<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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
        $user = Auth::guard('web')->user();
        if ($request->user_id != 0) {
            $plan = DB::table('plans')->where('id', $request->plan_id)->first();
            if (!is_null($user)) {
                $array = [
                    'user_id' => $user->id,
                    'amount' => $plan->amount * 100,
                    'frequency' => 'month',
                    'duration' => $plan->duration,
                    'email' => $user->email,
                    'name' => $user->name,
                    'phone' => $user->contact_no,
                    'plan_id' => $plan->id,
                    'stripe_customer_id' => $user->stripe_customer_id,
                    'currency_code' => 'AUD',
                ];

                $result = $this->subscriptionPayment($array);
                return response()->json([
                    'redirect_url' => $result['redirect_url']
                ]);
//            return redirect()->away($result['redirect_url']);
            }
        } else {
            return redirect()->route('login');
        }
    }

//    public function success(Request $request)
//    {
//        return "Thanks for your order! You have just completed your payment. The seller will reach out to you as soon as possible.";
//    }

    public function subscriptionPayment($array): array
    {

        try {
            $stripe = new \Stripe\StripeClient(
                config('stripe.sk')
            );
            $array['stripe_customer_id'] = null;
            if (empty($array['stripe_customer_id'])) {
                $customer = $stripe->customers->create([
                    'name' => $array['name'],
                    'description' => $array['name'],
                    'email' => $array['email'],
                    'phone' => $array['phone'],
                ]);
                $customer_id = $customer->id;
            } else {
                $customer_id = $array['stripe_customer_id'];
                $stripe->customers->update(
                    $customer_id,
                    [
                        'name' => $array['name'],
                        'description' => $array['name'],
                        'email' => $array['email'],
                        'phone' => $array['phone'],
                    ]
                );
            }

            if ($array['plan_id'] == 2) {
                $text = '3-Month HackHeroes Program - Monthly Payments';
            } elseif ($array['plan_id'] == 3) {
                $text = '3-Month Full Access To HackHeroes Program - Cancel Anytime';
            } else {
                $text = $array['duration'] . ' ' . $array['frequency'] . ' Hack Heroes Subscription';
            }
            $product = $stripe->products->create([
                'name' => $text,
            ]);

            $price = $stripe->prices->create([
                'unit_amount' => $array['amount'],
                'currency' => $array['currency_code'],
                'recurring' => [
                    'interval' => $array['frequency'],
                    'interval_count' => 1
                ],
                'product' => $product->id
            ]);
            $session = $stripe->checkout->sessions->create([
                'customer' => $customer_id,
                'line_items' => [
                    [
                        'price' => $price->id,
                        'quantity' => 1,
                    ]
                ],
                'mode' => 'subscription',
                'allow_promotion_codes' => true,
                'success_url' => route('payment-success'),
                'cancel_url' => route('payment-error'),
            ]);

            Session::put('customer_id', $customer_id);
            Session::put('payment_id', $session->id);
            Session::put('plan_id', $array['plan_id']);
            return [
                'success' => true,
                'message' => 'Payment Done',
                'redirect_url' => $session->url,
                'customer_id' => $customer_id,
                'payment_id' => $session->id
            ];

        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }
}
