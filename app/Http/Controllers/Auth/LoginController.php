<?php

namespace App\Http\Controllers\Auth;


use URL;
use Session;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
        |--------------------------------------------------------------------------
        | Login Controller
        |--------------------------------------------------------------------------
        |
        | This controller handles authenticating users for the application and
        | redirecting them to your home screen. The controller uses a trait
        | to conveniently provide its functionality to your applications.
        |
        */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /** index page login */
    public function login()
    {
        return view('auth.login');
    }

    /** login with databases */
    public function authenticate(Request $request)
    {
        $request->validate([
            'email'    => 'required|string',
            'password' => 'required|string',
        ]);

        try {

            $email     = $request->email;
            $password  = $request->password;

            if (Auth::attempt(['email' => $email, 'password' => $password], $request->remember)) {
                $user = Auth::user();
                $data = [];
                $data['response_code']  = '200';
                $data['status']         = 'success';
                $data['message']        = 'success Login';
                if ($user->role === 'admin') {
                    $data['url']        = '/admin/admin_dahsboard';
                } elseif ($user->role === 'user') {
                    $data['url']        = '/';
                }
                return response()->json($data);
            } else {
                $data = [];
                $data['response_code']  = '400';
                $data['status']         = 'error';
                $data['message']        = 'fail Login';
                return response()->json($data);
            }
        } catch (\Exception $e) {
            \Log::info($e);
            DB::rollback();
            $data = [];
            $data['response_code']  = '400';
            $data['status']         = 'error';
            $data['message']        = 'fail Login';
            return response()->json($data);
        }

        // $data = [];
        // $data['response_code']  = '200';
        // $data['status']         = 'success';
        // $data['message']        = 'success Login';
        // $data['info_user']      = $user;
        // $data['token']          = $accessToken;
        // return response()->json($data);
    }

    /** logout */
    public function logout(Request $request)
    {
        Auth::logout();
        // forget login session
        $request->session()->forget('name');
        $request->session()->forget('email');
        $request->session()->forget('user_id');
        $request->session()->forget('join_date');
        $request->session()->forget('last_login');
        $request->session()->forget('phone_number');
        $request->session()->forget('status');
        $request->session()->forget('role_name');
        $request->session()->forget('avatar');
        $request->session()->forget('position');
        $request->session()->forget('department');
        $request->session()->flush();
        return redirect('login');
    }
}
