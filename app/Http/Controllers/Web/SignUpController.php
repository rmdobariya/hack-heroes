<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\SignUp1Request;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SignUpController extends Controller
{
    public function index()
    {
        return view('website.auth.signup',);
    }

    public function signUp2(SignUp1Request $request)
    {
        Session::put('name', $request->name);
        Session::put('email', $request->email);
    }


    public function signUp2View()
    {
        return view('website.auth.signup_2');
    }

    public function signUp3(Request $request)
    {
        Session::put('child_name', $request->name);
    }

    public function signUp3View()
    {
        return view('website.auth.signup_3');
    }

    public function signUp4(Request $request)
    {
        Session::put('password', $request->password);
    }

    public function signUp4View()
    {
        return view('website.auth.signup_4');
    }

    public function signUp5(Request $request)
    {
        Session::put('plan', $request->plan);
        Session::put('term_condition', $request->term_condition);
    }

    public function signUp5View()
    {
        return view('website.auth.signup_5');
    }

    public function signUp6(Request $request)
    {
        Session::put('age', $request->age);
        Session::put('sex', $request->sex);
        Session::put('current_health', $request->current_health);
        Session::put('previous_health', $request->previous_health);
        Session::put('language', $request->language);
        Session::put('sexual_orientation', $request->sexual_orientation);
        Session::put('family_structure', $request->family_structure);
        Session::put('access_the_internet', $request->access_the_internet);
        Session::put('online_activity_frequency', $request->online_activity_frequency);
        Session::put('online_behaviour', $request->online_behaviour);
        Session::put('geographic_location', $request->geographic_location);
        Session::put('socioeconomic_status', $request->socioeconomic_status);
        Session::put('school_attendance', $request->school_attendance);
        Session::put('parental_involvement', $request->parental_involvement);
        Session::put('support_system', $request->support_system);
        Session::put('peer_relationships', $request->peer_relationships);
        Session::put('relationship_status', $request->relationship_status);
        Session::put('school_climate', $request->school_climate);
        Session::put('academic_performance', $request->academic_performance);
    }

    public function signUp6View()
    {
        return view('website.auth.signup_6');
    }

    public function signUpStore(Request $request)
    {
        $user = new User();
        $user->name = Session::get('name');
        $user->full_name = Session::get('name');
        $user->email = Session::get('email');
        $user->password = Hash::make(Session::get('password'));
        $user->save();
        Session::forget('name');
        Session::forget('email');
        Session::forget('password');
        Session::forget('plan');
        Session::forget('term_condition');
        Session::forget('age');
        Session::forget('sex');
        Session::forget('current_health');
        Session::forget('previous_health');
        Session::forget('language');
        Session::forget('sexual_orientation');
        Session::forget('family_structure');
        Session::forget('access_the_internet');
        Session::forget('online_activity_frequency');
        Session::forget('online_behaviour');
        Session::forget('geographic_location');
        Session::forget('socioeconomic_status');
        Session::forget('school_attendance');
        Session::forget('parental_involvement');
        Session::forget('support_system');
        Session::forget('peer_relationships');
        Session::forget('relationship_status');
        Session::forget('school_climate');
        Session::forget('academic_performance');
        return response()->json([
            'success' => true,
            'message' => 'User Register Successfully'
        ]);
    }
}
