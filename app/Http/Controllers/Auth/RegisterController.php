<?php

namespace App\Http\Controllers\Auth;

use DB;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    /** page register new */
    public function index()
    {
        return view('auth.register');
    }

    /** save new record */
    public function saveRecord(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
        ]);
        try {
            $dt        = Carbon::now();
            $join_date = $dt->toDayDateTimeString();

            $user = new User();
            $user->name         = $request->first_name . $request->last_name;
            $user->email        = $request->email;
            $user->join_date    = $join_date;
            $user->password     = Hash::make($request->password);
            $user->save();


            $data = [];
            $data['response_code']  = '200';
            $data['status']         = 'success';
            $data['message']        = 'success Register';
            return response()->json($data);
        } catch (\Exception $e) {
            \Log::info($e);
            $data = [];
            $data['response_code']  = '400';
            $data['status']         = 'error';
            $data['message']        = $e;
            return response()->json($data);
        }
    }
}
