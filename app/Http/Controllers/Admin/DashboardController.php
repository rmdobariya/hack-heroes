<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminLoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
   public function index()
   {
       $contact_us_count = DB::table('contact_us')->whereNull('deleted_at')->count();
       return view('admin.dashboard.dashboard',[
           'contact_us_count' => $contact_us_count
       ]);
   }
}
