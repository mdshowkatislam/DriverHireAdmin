<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRegisterRequest;
use App\Http\Requests\ForgetPassRequest;
use App\Http\Requests\ResendOTPRequest;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Http\Requests\ValidateUserRequest;
use App\Http\Requests\VerifyOTPRequest;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthController extends Controller
{
    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('phone', 'password');

        if ($token = $this->guard()->attempt(array_merge($credentials, ['status' => 1]))) {
            return $this->respondWithToken($token);
        }

        return sendError(
            'unauthorized attempt',
            [],
            Response::HTTP_UNAUTHORIZED
        );
    }


    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();

        return sendResponse(
            'Successfully logged out',
        );
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return sendResponse(
            'Successfully logged in',
            [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => $this->guard()->factory()->getTTL() * 60 * 60,
                'user'       => Auth::guard('api')->user()->with(['driverInfo', 'ownerInfo'])->first()
            ]
        );
    }


    public function register(ApiRegisterRequest $apiRegisterRequest)
    {

        $role = $apiRegisterRequest->input('role');

        $insertData['role_id'] = roleIdByRoleName($role);
        if ( $apiRegisterRequest->hasFile('photo') )
            $insertData['profile_photo_path'] = uploadImage($apiRegisterRequest->file('photo'), 'usersImages');

        $insertData = array_merge($insertData, [
            'first_name' => $apiRegisterRequest->input('first_name'),
            'status'     => 0,
            'last_name'  => $apiRegisterRequest->input('last_name'),
            'phone'      => $apiRegisterRequest->input('phone'),
            'password'   => Hash::make($apiRegisterRequest->input('password')),
            'full_name'  => $apiRegisterRequest->input('first_name') . " " . $apiRegisterRequest->input('last_name')
        ]);

        try {
            DB::beginTransaction();

            $user = User::create($insertData);

            if ( $role == "driver" ){
                insertDriverDetails($user, $apiRegisterRequest);
            } else {
                insertVehicleOwnerDetails($user, $apiRegisterRequest);
            }

            $otp = creatreOtp(4);

            $dateTime = date('Y-m-d H:i:s');

            storeOTP([
                'user_id' => $user->id,
                'otp'    => $otp,
                'expiration_date_time' => date('Y-m-d H:i:s', strtotime('+1 day', strtotime($dateTime))),
                'created_at' => $dateTime,
                'updated_at' => $dateTime
            ]);

            $message = "আপনার নিবন্ধন সম্পূর্ণ করতে এই OTP ব্যবহার করুন । OTP : " . $otp;

            sendSMS($apiRegisterRequest->input('phone'), $message);

            DB::commit();

            return sendResponse(
                'Registered successfully',
                [
                    'user' => $user
                ]
            );
        } catch (\Exception $exception){
            DB::rollBack();

            return sendError(
                'Something went wrong',
                [
                    'error' => $exception->getMessage()
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }


    public function validateUser(ValidateUserRequest $validateUserRequest)
    {
        $date = Carbon::now()->format('Y-m-d H:i:s');
        $checkOtp = Otp::where($validateUserRequest->only('user_id', 'otp'));


        if ( $checkOtp->exists() ){
            if ($checkOtp->where('expiration_date_time', '>=', $date)->exists()){
                $checkOtp->delete();

                User::where('id', $validateUserRequest->input('user_id'))->update(['status' => 1]);

                return sendResponse(
                    'User verified successfully',
                    []
                );
            } else {
                return sendError(
                    'OTP expired',
                    [],
                    Response::HTTP_UNPROCESSABLE_ENTITY
                );
            }
        }



        return sendError(
            'User or OTP not found',
            [],
            Response::HTTP_NOT_FOUND
        );
    }


    public function resend(ResendOTPRequest $resendOTPRequest)
    {
        $otp = Otp::where($resendOTPRequest->only('user_id'));

        if ( $otp->exists() ){
            try {
                $otpNumber = creatreOtp(4);
                $otp->update([
                    'otp'                 => $otpNumber,
                    'expiration_date_time' => date('Y-m-d H:i:s', strtotime("+2 minutes"))
                ]);

                $userPhone = User::where('id', $resendOTPRequest->input('user_id'))->first();

                $message = "আপনার নিবন্ধন সম্পূর্ণ করতে এই OTP ব্যবহার করুন । OTP : " . $otpNumber;

                sendSMS($userPhone->phone, $message);

                return sendResponse('OTP has been send');
            } catch (\Exception $exception){
                return sendError(
                    'Something went wrong',
                    [
                        'error' => $exception->getMessage()
                    ],
                    Response::HTTP_INTERNAL_SERVER_ERROR
                );
            }
        }

        return sendResponse(
            'User not found',
            [],
            Response::HTTP_NOT_FOUND
        );
    }

    public function forgetPassRequest(ForgetPassRequest $forgetPassRequest)
    {
        $user = User::where('phone', $forgetPassRequest->input('phone'))->first()->id;

        $otp = creatreOtp(4);

        $expireTime = date('Y-m-d H:i:s', strtotime('+1 day', strtotime(date('Y-m-d H:i:s'))));

        storeOTP([
            'user_id' => $user,
            'otp'    => $otp,
            'expiration_date_time' => $expireTime,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $message = "আপনার পাসওয়ার্ড রিসেট করতে এই OTP ব্যবহার করুন । OTP : " . $otp;

        sendSMS($forgetPassRequest->input('phone'), $message);

        return sendResponse(
            'OTP has been send',
            [
                'user_id' => $user,
                'otp' => $otp,
                'expire_time' => $expireTime
            ]
        );
    }


    public function resetPassword(VerifyOTPRequest $verifyOTPRequest)
    {
        $date = Carbon::now()->format('Y-m-d H:i:s');
        $checkOtp = Otp::where($verifyOTPRequest->only('user_id', 'otp'));

        if ( $checkOtp->exists() ){
            if ($checkOtp->where('expiration_date_time', '>=', $date)->exists()){
                $checkOtp->delete();

                User::where('id', $verifyOTPRequest->input('user_id'))->update(['password' => Hash::make($verifyOTPRequest->input('password'))]);

                return sendResponse(
                    'Password changed successfully',
                    []
                );
            } else {
                return sendError(
                    'OTP expired',
                    [],
                    Response::HTTP_UNPROCESSABLE_ENTITY
                );
            }
        }
    }


    public function updateProfile(UpdateUserProfileRequest $updateUserProfileRequest)
    {
         $user = Auth::guard('api')->user();

         if ( $updateUserProfileRequest->hasFile('photo') ){
             $updateUserProfileRequest->merge([
                'profile_photo_path' => uploadImage($updateUserProfileRequest->file('photo'), 'usersImages')
            ]);

             unset($updateUserProfileRequest['photo']);
         }

         $updateUserProfileRequest->merge([
            'updated_at' => date('Y-m-d H:i:s'),
             'full_name' => $updateUserProfileRequest->input('first_name') . ' ' . $updateUserProfileRequest->input('last_name'),
        ]);

         if ( $updateUserProfileRequest->has('password') ){
             $updateUserProfileRequest->merge([
                 'password' => Hash::make($updateUserProfileRequest->input('password'))
             ]);
         }


        $user->update($updateUserProfileRequest->except('photo'));

        return sendResponse(
            'Profile updated successfully',
            [
                'user' => $user
            ],
            Response::HTTP_OK
        );
    }


    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard('api');
    }
}
