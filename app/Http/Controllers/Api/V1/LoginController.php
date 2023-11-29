<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\LoginWithEmailRequest;
use App\Http\Requests\API\RegisterStoreRequest;
use App\Models\Device;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(LoginWithEmailRequest $request): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validated();
        try {
            $credentials = $request->only('email', 'password');
            if (!Auth::attempt($credentials)) {
                return response()->json([
                    'message' => 'Invalid Email Or Password',
                ], 422);
            }
            $user = User::where('email', $validated['email'])->first();
            if ((string)$user->status === 'active') {
                $this->addDeviceToken($user->id, $validated['device_type'], $validated['device_token']);
                $token = $user->createToken('authToken')->plainTextToken;
                return response()->json([
                    'token' => $token,
                ]);
            }
            return response()->json([
                'message' => 'Account Is Inactive',
            ], 422);
        } catch (\Exception $error) {
            return response()->json([
                'message' => $error->getMessage(),
                'error' => $error->getMessage(),
            ], 422);
        }
    }

    public function register(RegisterStoreRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $tokenResult = $user->createToken('authToken')->plainTextToken;
        $this->addDeviceToken($user->id, $request->device_type, $request->device_token);
        return response()->json([
            'token' => $tokenResult,
            'message' => 'User registration successfully'
        ]);
    }
    public function addDeviceToken($user_id, $device_type, $device_token): bool
    {
        $this->deleteToken($device_token);
        $device = new Device();
        $device->user_id = $user_id;
        $device->device_type = $device_type;
        $device->device_token = $device_token;
        $device->save();
        return true;
    }

    public function deleteToken($device_token): bool
    {
        Device::where('device_token', $device_token)->delete();
        return true;
    }
}
