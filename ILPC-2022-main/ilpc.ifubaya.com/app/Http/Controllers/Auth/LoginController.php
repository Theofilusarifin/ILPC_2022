<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function redirectTo()
    {
        switch (Auth::user()->role) {
            case 'sekretariat':
                $this->redirectTo = '/sekretariat';
                return $this->redirectTo;
                break;
            case 'soal':
                $this->redirectTo = '/soal';
                return $this->redirectTo;
                break;
            case 'acara':
                $this->redirectTo = '/acara';
                return $this->redirectTo;
                break;
            case 'penpos':
                $this->redirectTo = '/penpos';
                return $this->redirectTo;
                break;
            case 'pemain':
                $this->redirectTo = '/pemain';
                return $this->redirectTo;
                break;
            default:
                $this->redirectTo = '/login';
                return $this->redirectTo;
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // abort(404);
        $this->middleware('guest')->except('logout');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'username';
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
            'g-recaptcha-response' => 'required|captcha'
        ]);
    }

    // Untuk login cuma bisa 1 user
    protected function authenticated(Request $request, $user)
    {
        Auth::logoutOtherDevices($request['password']);
    }
}
