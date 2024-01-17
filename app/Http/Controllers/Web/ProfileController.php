<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\UpdateProfileRequest;
use App\Models\User;
use App\Models\UserChildren;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = Auth::guard('web')->user();        
        $user_childrens = DB::table('user_childrens')->where('user_id', $user->id)->get();
        $terms_condition = DB::table('site_settings')->where('setting_key', 'TERMS_CONDITION')->first()->setting_value;
        $privacy_policy = DB::table('site_settings')->where('setting_key', 'PRIVACY_POLICY')->first()->setting_value;
        return view('website.profile.profile', [
            'user' => $user,
            'user_childrens' => $user_childrens,
            'terms_condition' => $terms_condition,
            'privacy_policy' => $privacy_policy,
        ]);
    }

    public function updateProfile()
    {
        $user = Auth::guard('web')->user();
        $user_childrens = DB::table('user_childrens')->where('user_id', $user->id)->get();
        return view('website.profile.update-profile', [
            'user' => $user,
            'user_childrens' => $user_childrens,
        ]);
    }

    public function updateProfileStore(UpdateProfileRequest $request)
    {
        $user = User::find($request->user_id);
        $user->name = $request->name;
        $user->full_name = $request->name;
        $user->email = $request->email;
        $user->save();
        if (isset($request->children_name)) {
            foreach ($request->children_name as $key => $name) {
                $user_children = UserChildren::find($key);
                $user_children->name = $name;
                $user_children->save();
            }
        }
        return response()->json([
            'success' => true,
            'message' => 'Setting Update Successfully'
        ]);
    }
}
