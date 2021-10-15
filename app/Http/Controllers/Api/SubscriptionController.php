<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Subscription\SubscriptionInterface;
use App\Repositories\User\UserInterface;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    protected $user;
    protected $subscription;

    public function __construct(UserInterface $user, SubscriptionInterface $subscription)
    {
        $this->user = $user;
        $this->subscription = $subscription;
    }

    public function store(Request $request)
    {
        $rules = [
            'law_firm_name' => 'required',
            'law_firm_address' => 'required',
            'token' => 'required',
        ];

        //validation check
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }
}
