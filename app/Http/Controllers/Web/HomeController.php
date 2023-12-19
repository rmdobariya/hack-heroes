<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\GetInTouchRequest;
use App\Models\ContactUs;

class HomeController extends Controller
{
    public function index()
    {
        return view('website.home.index',);
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
