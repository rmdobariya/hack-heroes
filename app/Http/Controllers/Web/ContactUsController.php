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
        $fb_link = DB::table('site_settings')->where('setting_key','FACEBOOK_LINK')->first()->setting_value;
        $insta_link = DB::table('site_settings')->where('setting_key','INSTAGRAM_LINK')->first()->setting_value;
        $linkedin_link = DB::table('site_settings')->where('setting_key','LINKEDIN_LINK')->first()->setting_value;
        return view('website.contact-us.index', [
            'fb_link' => $fb_link,
            'insta_link' => $insta_link,
            'linkedin_link' => $linkedin_link,
        ]);
    }

    public function getInTouch(GetInTouchRequest $request)
    {
        if (!is_null($request->name) && !is_null($request->email) && !is_null($request->message)) {
            $contact_us = new ContactUs();
            $contact_us->name = $request->name;
            $contact_us->email = $request->email;
            $contact_us->message = $request->message;
            $contact_us->save();
            return response()->json([
                'success' => true,
                'message' => 'Contact Us Request Submit Successfully'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Contact Us Request Submit Successfully'
            ]);
        }

    }
}
