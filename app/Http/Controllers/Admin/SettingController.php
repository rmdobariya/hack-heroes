<?php

namespace App\Http\Controllers\Admin;


use App\Helpers\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ContactInfoStoreRequest;
use App\Http\Requests\Admin\FooterStoreRequest;
use App\Http\Requests\Admin\GeneralSettingStoreRequest;
use App\Http\Requests\Admin\EmailSettingStoreRequest;
use App\Http\Requests\Admin\AppSettingStoreRequest;
use App\Http\Requests\Admin\SocialMediaStoreRequest;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SettingController extends Controller
{

//    function __construct()
//    {
//        $this->middleware('permission:setting-read|setting-create|setting-update|setting-delete', ['only' => ['index']]);
//        $this->middleware('permission:setting-create', ['only' => ['create', 'store']]);
//        $this->middleware('permission:setting-update', ['only' => ['edit', 'update']]);
//        $this->middleware('permission:setting-delete', ['only' => ['destroy']]);
//    }

    public function index()
    {
        $settings = SiteSetting::select(['setting_key', 'setting_value'])->get();
        return view('admin.setting.index', [
            'settings' => $settings,
        ]);
    }

    public function generalSettingStore(GeneralSettingStoreRequest $request)
    {

        if ($request->hasfile('LOGO_IMG')) {
            $logo = ImageUploadHelper::imageUpload($request->file('LOGO_IMG'), 'logo');
            DB::table('site_settings')->where('setting_key', 'LOGO_IMG')->update([
                'setting_value' => $logo
            ]);
        }
        if ($request->hasfile('FAVICON_IMG')) {
            $favicon_icon = ImageUploadHelper::imageUpload($request->file('FAVICON_IMG'), 'logo');
            DB::table('site_settings')->where('setting_key', 'FAVICON_IMG')->update([
                'setting_value' => $favicon_icon
            ]);
        }
        if ($request->setting_key['SITE_TITLE']) {
            DB::table('site_settings')->where('setting_key', 'SITE_TITLE')->update([
                'setting_value' => $request->setting_key['SITE_TITLE']
            ]);
        }

        return response()->json(['message' => 'General Setting Update Successfully',]);
    }

    public function emailSettingStore(EmailSettingStoreRequest $request)
    {
        $array = $request->setting_key;
        foreach ($array as $key => $setting_value) {
            DB::table('site_settings')->where('setting_key', $key)->update([
                'setting_value' => $setting_value
            ]);
            Config::set([$key => $setting_value]);
        }
        return response()->json([
            'message' => 'Email Setting Update Successfully',
        ]);
    }

    public function appSettingStore(AppSettingStoreRequest $request)
    {
        $array = $request->setting_key;
        foreach ($array as $key => $setting_value) {
            DB::table('site_settings')->where('setting_key', $key)->update([
                'setting_value' => $setting_value
            ]);

        }
        return response()->json([
            'message' => 'App Setting Update Successfully',
        ]);
    }

    public function contactInfoStore(ContactInfoStoreRequest $request)
    {
        $array = $request->setting_key;
        foreach ($array as $key => $setting_value) {
            DB::table('site_settings')->where('setting_key', $key)->update([
                'setting_value' => $setting_value
            ]);
        }

        return response()->json([
            'message' => 'Contact Info Update Successfully',
        ]);
    }

    public function socialMediaStore(SocialMediaStoreRequest $request)
    {
        $array = $request->setting_key;
        foreach ($array as $key => $setting_value) {
            DB::table('site_settings')->where('setting_key', $key)->update([
                'setting_value' => $setting_value
            ]);
        }

        return response()->json([
            'message' => 'Social Media Update Successfully',
        ]);
    }
    public function footerStore(Request $request)
    {
        if ($request->hasfile('TERMS_CONDITION')) {
            $terms_condition = ImageUploadHelper::imageUpload($request->file('TERMS_CONDITION'), 'assets/web/document');
            DB::table('site_settings')->where('setting_key', 'TERMS_CONDITION')->update([
                'setting_value' => $terms_condition
            ]);
        }
        if ($request->hasfile('PRIVACY_POLICY')) {
            $privacy_policy = ImageUploadHelper::imageUpload($request->file('PRIVACY_POLICY'), 'assets/web/document');
            DB::table('site_settings')->where('setting_key', 'PRIVACY_POLICY')->update([
                'setting_value' => $privacy_policy
            ]);
        }
        return response()->json([
            'message' => 'Footer File Update Successfully',
        ]);
    }

}
