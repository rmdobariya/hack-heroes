<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\SignUp1Request;
use App\Models\User;
use App\Models\UserChildren;
use App\Models\UserChildrenDetail;
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
        $childrens = Session::get('child_name');
        return view('website.auth.signup_4', [
            'childrens' => $childrens
        ]);
    }

    public function signUp5(Request $request)
    {

        $create_plan = $request->create_plan;
        $child_name = Session::get('child_name');
        $result = [];
        foreach ($child_name as $key => $value) {
            $result[$value] = $create_plan[$key] ?? 'off';
        }
        Session::put('create_plan', $result);
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
        $user_childrens = Session::get('child_name');
        $plan = Session::get('create_plan');
        $user = new User();
        $user->name = Session::get('name');
        $user->full_name = Session::get('name');
        $user->term_condition = 1;
        $user->email = Session::get('email');
        $user->password = Hash::make(Session::get('password'));
        $user->save();
        if (!empty($user_childrens)) {
            foreach ($user_childrens as $children) {
                $user_children = new UserChildren();
                $user_children->name = $children;
                $user_children->user_id = $user->id;
                if ($plan[$children] == 'on') {
                    $user_children->is_plan = 1;
                }
                $user_children->save();

                $user_children_detail = new UserChildrenDetail();
                $user_children_detail->user_id = $user->id;
                $user_children_detail->user_children_id = $user_children->id;
                $user_children_detail->age = Session::get('age');
                $user_children_detail->sex = Session::get('sex');
                $user_children_detail->current_health = Session::get('current_health');
                $user_children_detail->previous_health = Session::get('previous_health');
                $user_children_detail->language = Session::get('language');
                $user_children_detail->sexual_orientation = Session::get('sexual_orientation');
                $user_children_detail->family_structure = Session::get('family_structure');
                $user_children_detail->access_the_internet = Session::get('access_the_internet');
                $user_children_detail->online_activity_frequency = Session::get('online_activity_frequency');
                $user_children_detail->online_behaviour = Session::get('online_behaviour');
                $user_children_detail->geographic_location = Session::get('geographic_location');
                $user_children_detail->socioeconomic_status = Session::get('socioeconomic_status');
                $user_children_detail->school_attendance = Session::get('school_attendance');
                $user_children_detail->parental_involvement = Session::get('parental_involvement');
                $user_children_detail->support_system = Session::get('support_system');
                $user_children_detail->peer_relationships = Session::get('peer_relationships');
                $user_children_detail->relationship_status = Session::get('relationship_status');
                $user_children_detail->school_climate = Session::get('school_climate');
                $user_children_detail->academic_performance = Session::get('academic_performance');
                $user_children_detail->save();
            }
        }
        Session::forget('name');
        Session::forget('email');
        Session::forget('password');
        Session::forget('create_plan');
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

    public function getAttributeRow($rowNo)
    {
        $response = view('website.auth.getAttribute', [
            'rowNo' => $rowNo,
        ])->render();
        return response()->json(['data' => $response]);
    }
}
