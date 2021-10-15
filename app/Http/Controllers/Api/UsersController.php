<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\User\UserInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    protected $user;

    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    public function login(Request $request)
    {
        //set validation rules
        $rules = [
            'phone' => 'required',
            'password' => 'required',
        ];

        //make validation
        $validation = Validator::make($request->all(), $rules);

        //check validation
        if ($validation->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validation->errors()
            ]);
        }

        return $this->user->login($request);
    }

    public function register(Request $request)
    {
        //set validation rules
        $rules = [
            'name' => 'required',
            'phone' => 'required|unique:users,phone',
            'email' => 'unique:users,email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ];

        //make validation
        $validation = Validator::make($request->all(), $rules);

        //check validation
        if ($validation->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validation->errors()
            ]);
        }

        return $this->user->register($request);
    }

    public function otpVerify(Request $request)
    {
        //validation rules
        $rules = [
            'token' => 'required',
            'verification_code' => 'required',
        ];

        //validation check
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        //check with verification code
        $verify = $this->user->otpVerify($request, Auth::user()->id);

        if ($verify) {
            return response()->json([
                'status' => true,
                'message' => 'Verified successfully'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Failed to verify'
        ]);
    }

    public function otpResend(Request $request)
    {
        //validation rules
        $rules = [
            'token' => 'required',
            'phone' => 'required'
        ];

        //validation check
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        //check with verification code
        $resend = $this->user->otpResend($request);

        if ($resend) {
            return response()->json([
                'status' => true,
                'message' => 'Resend a verification code'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Failed to resend verification code'
        ]);
    }
}
