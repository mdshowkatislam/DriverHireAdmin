<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;



    public function showResetForm(Request $request)
    {
        $phone = $request->query('phone');

        return view('auth.passwords.reset', ['phone' => $phone]);
    }


    public function reset(Request $request)
    {
        $phone = $request->input('phone');
        $otp = $request->input('otp');
        $pass = $request->input('password');
        $confirm = $request->input('password_confirmation');

        if ( $pass != $confirm ){
            Session::put('error_pass', 'Confirm password did not matched');

            return redirect()->back();
        }

        $user = Admin::where('phone', $phone);

        if ( $user->exists() ){
            $date = date('Y-m-d H:i:s');
            $passResetTable = DB::table('password_resets')->where([
                'phone' => $phone,
                'token' => $otp
            ]);

            if ( $passResetTable->exists() ){

                if ( ! $passResetTable->where('created_at', '>=', $date)->exists()){
                    $passResetTable->delete();
                    Session::put('error', 'OTP expired , try again');
                    return redirect(route('password.request'));
                }

                $passResetTable->delete();

                $user->update([
                    'password' => Hash::make($pass),
                    'updated_at' => $date
                ]);

                Session::put('pass_reset_success', 'Successfully reset password , please login');
                return redirect(route('login'));
            } else {
                Session::put('error', 'OTP not found');
                return redirect()->back();
            }

        }
        Session::put('error', 'User not found');
        return redirect()->back();

    }
}
