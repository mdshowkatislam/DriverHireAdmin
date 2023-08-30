<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;


    protected function validateEmail(Request $request)
    {
        $request->validate(['phone' => 'required']);
    }


    protected function credentials(Request $request)
    {
        return $request->only('phone');
    }


    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        $user = User::where($request->only('phone'))->first();

        if ( $user ){
            try {
                $otp = creatreOtp(4);

                $date = date('Y-m-d H:i:s', strtotime('+4 minutes'));

                $message = " আপনার পাসওয়ার্ড রিসেট OTP : " . $otp;

                sendSMS($request->input('phone'), $message);

                storePassResetOTP([
                    'token' => $otp,
                    'created_at' => $date,
                    'phone' => $request->input('phone')
                ]);

                return redirect(route('password.reset', 'phone') . '?phone=' . urlencode($request->input('phone')));
            } catch (\Exception $exception){
                Session::put('error', 'Something went wrong');
                return redirect()->back();
            }
        } else {
            Session::put('error', 'User not found');
            return redirect()->back();
        }

    }
}
