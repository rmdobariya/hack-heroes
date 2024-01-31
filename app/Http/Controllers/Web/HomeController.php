<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\GetInTouchRequest;
use App\Http\Requests\Web\SubscribeStoreRequest;
use App\Mail\VerifyMail;
use App\Mail\WelcomeMail;
use App\Models\ContactUs;
use App\Models\Subscribe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class HomeController extends Controller
{
    public function index()
    {
        // $user = Auth::guard('web')->user();
        // $token = Password::getRepository()->create($user);
        // $array = [
        //     'name' => $user->name,
        //     'actionUrl' => route('verify-email', [$token]),
        //     'mail_title' => 'Verify Mail',
        //     'main_title_text' => 'Verify Mail',
        //     'subject' => 'Verify Mail',
        // ];
        // Mail::to($user->email)->send(new VerifyMail($array));
        $plans = DB::table('plans')->whereNull('deleted_at')->get();
        $faqs = DB::table('faqs')->whereNull('deleted_at')->get();
        return view('website.home.index', [
            'plans' => $plans,
            'faqs' => $faqs,
        ]);
    }

    public function getInTouch(GetInTouchRequest $request)
    {
        $contact_us = new ContactUs();
        $contact_us->name = $request->name;
        $contact_us->email = $request->email;
        $contact_us->message = $request->message;
        $contact_us->save();
        $message = 'Form submitted successfully.';
        return response()->json([
            'success' => true,
            'message' => $message
        ]);
    }

    public function subscribe(SubscribeStoreRequest $request)
    {
        $subscribe = new Subscribe();
        $subscribe->email = $request->email;
        $subscribe->save();
        return response()->json([
            'success' => true,
            'message' => 'Your email has been subscribed successfully.'
        ]);
    }
}
