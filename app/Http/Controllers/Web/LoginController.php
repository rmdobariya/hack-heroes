<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\UserLoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::guard('web')->user()) {
            return redirect(route('dashboard'));
        }
        return view('website.auth.login',);
    }

    public function loginCheck(UserLoginRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $user = User::query()
            ->where('email', $validated['email'])
            ->where('user_type', 'user')
            ->first();
        if (empty($user)) {
            return response()->json([
                'message' => 'Invalid Email',
            ], 401);
        } else if (!Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'message' => 'Invalid Password',
            ], 401);
        } else {
            Auth::guard('web')->login($user);
            return response()->json([
                'message' => 'Login Successful.',
            ]);
        }
    }

    public function logout(): RedirectResponse
    {
        Auth::guard('web')->logout();
        return redirect()->route('login');
    }
}
