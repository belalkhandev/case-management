<?php
namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserInterface{

    public function login($request)
    {
        $credentials = $request->only('phone', 'password');

        if ($authorized = Auth::guard()->attempt($credentials)) {
            $user = Auth::guard()->user();

            if ($user) {
                $token = $user->createToken('case')->accessToken;

                return response()->json([
                    'status' => true,
                    'message' => 'Logged in successfully',
                    'user' => $user,
                    'token' => $token
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Failed to Login, Invalid credentials',
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Failed to login, Invalid credentials'
            ]);
        }
    }

    public function register($request)
    {
        //register new user
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->password = app('hash')->make($request->input('password'));
        $user->verify_code = rand(111111, 999999);

        if ($user->save()) {
            $token = $user->createToken('case')->accessToken;

            return response()->json([
                'status' => true,
                'message' => 'User Registered Successfully',
                'user' => $user,
                'token' => $token
            ]);
        }

        return false;
    }

    public function otpVerify($request, $user_id)
    {
        $user = User::where($request->input('verification_code'))->where('id', $user_id)->first();

        if ($user) {
            $user->is_verified = 1;

            if ($user->save()) {
                return $user;
            }
        }

        return  false;
    }

    public function otpResend($request)
    {
        //register new user
        $user = User::where('phone', $request->input('phone'))->first();

        if ($user) {
            $user->verify_code = rand(111111, 999999);

            if ($user->save()) {
                return $user;
            }
        }

        return  false;
    }

}
