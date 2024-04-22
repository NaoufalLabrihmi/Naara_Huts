<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email_phone' => 'required|string',
            'password' => 'required|string',
        ]);

        try {
            $credentials = $this->getCredentials($request);

            if (Auth::attempt($credentials, $request->remember)) {
                $user = Auth::user();
                $url = ($user->role_id === 1) ? '/admin/dashboard' : '/user/booking';

                return response()->json([
                    'response_code' => '200',
                    'status' => 'success',
                    'message' => 'Success Login',
                    'url' => $url,
                ]);
            } else {
                return response()->json([
                    'response_code' => '400',
                    'status' => 'error',
                    'message' => 'Invalid credentials',
                ]);
            }
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json([
                'response_code' => '400',
                'status' => 'error',
                'message' => 'Failed to login',
            ]);
        }
    }

    protected function getCredentials(Request $request)
    {
        $emailOrPhone = $request->input('email_phone');
        $password = $request->input('password');

        // Check if the input is an email
        if (filter_var($emailOrPhone, FILTER_VALIDATE_EMAIL)) {
            return ['email' => $emailOrPhone, 'password' => $password];
        }

        // Check if the input is a phone number
        if (preg_match('/^[0-9]+$/', $emailOrPhone)) {
            return ['phone' => $emailOrPhone, 'password' => $password];
        }

        // Invalid input format (neither email nor phone)
        return [];
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
