<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use App\Models\User;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /** page reset password */
    public function getPassword($token)
    {
       return view('auth.passwords.reset', ['token' => $token]);
    }

    /** update new password */
    public function updatePassword(Request $request)
    {
        try {

            $updatePassword = DB::table('password_resets')->where(['email' => $request->email, 'token' => $request->token])->first();
            
            if (!$updatePassword) {
                $data = [];
                $data['response_code']  = '401';
                $data['status']         = 'error';
                $data['message']        = 'Invalid token! :)';
                return response()->json($request->token);
            } else { 
                $update = [
                    'password' => Hash::make($request->password),
                ];
                User::where('email', $request->email)->update($update);
                DB::table('password_resets')->where(['email'=> $request->email])->delete();

                $data = [];
                $data['response_code']  = '200';
                $data['status']         = 'success';
                $data['message']        = 'Your password has been changed! :)';
                return response()->json($data);
            }
        } catch(\Exception $e) {
            \Log::info($e);
            DB::rollback();
            $data = [];
            $data['response_code']  = '400';
            $data['status']         = 'error';
            $data['message']        = 'fail Update! :)';
            return response()->json($data);
        }
    }
}