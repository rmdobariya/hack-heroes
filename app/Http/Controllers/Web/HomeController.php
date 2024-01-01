<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\GetInTouchRequest;
use App\Http\Requests\Web\SubscribeStoreRequest;
use App\Models\ContactUs;
use App\Models\Subscribe;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $plans = DB::table('plans')->whereNull('deleted_at')->get();
        $faqs = DB::table('faqs')->whereNull('deleted_at')->get();
        return view('website.home.index',[
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
        return response()->json([
            'success' => true,
            'message' => 'Contact Us Request Submit Successfully'
        ]);
    }
    public function subscribe(SubscribeStoreRequest $request)
    {
        $subscribe = new Subscribe();
        $subscribe->email = $request->email;
        $subscribe->save();
        return response()->json([
            'success' => true,
            'message' => 'Subscribe Successfully'
        ]);
    }
}
