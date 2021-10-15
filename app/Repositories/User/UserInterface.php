<?php
namespace App\Repositories\User;

interface UserInterface{

    public function login($request);

    public function register($request);

    public function otpVerify($request, $user_id);

    public function otpResend($request);

}
