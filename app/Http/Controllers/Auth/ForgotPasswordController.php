<?php

namespace App\Http\Controllers\Auth;

use DB;
use Mail;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

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

    /** send email forgot password */
    public function sendEmail()
    {
        return view('auth.passwords.email');
    }

    /** post email */
    public function postEmail(Request $request)
    {
        try {

            $token = Str::random(60);
            $email = $request->email;
            $passwordReset = [
                'email'      => $email,
                'token'      => $token,
                'created_at' => Carbon::now(),
            ];
            DB::table('password_resets')->insert($passwordReset);

            Mail::send('auth.verify',['token' => $token], function($message) use ($request,$email) {
                $message->from($request->email);
                $message->to($email); /** input your email to send */
                $message->subject('Reset Password Notification');
            });

            $data = [];
            $data['response_code']  = '200';
            $data['status']         = 'success';
            $data['message']        = 'success Post Email';
            return response()->json($data);
        } catch(\Exception $e) {
            \Log::info($e);
            DB::rollback();
            $data = [];
            $data['response_code']  = '400';
            $data['status']         = 'error';
            $data['message']        = 'fail Send Email';
            return response()->json($data);
        }
    }
}
