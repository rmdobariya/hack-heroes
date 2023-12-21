<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\GetInTouchRequest;
use App\Models\ContactUs;
use Illuminate\Support\Facades\DB;

class ContactUsController extends Controller
{
    public function index()
    {
        $facebook_link = DB::table('site_settings')->where('setting_key', 'FACEBOOK_LINK')->first()->setting_value;
        $insta_link = DB::table('site_settings')->where('setting_key', 'INSTAGRAM_LINK')->first()->setting_value;
        return view('website.contact-us.index', [
            'facebook_link' => $facebook_link,
            'insta_link' => $insta_link,
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
}
