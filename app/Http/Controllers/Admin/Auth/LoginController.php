<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\CheckLoginRequest;
class LoginController extends Controller
{
    protected $redirectTo = RouteServiceProvider::ADMIN;
    use AuthenticatesUsers;
    public function __construct()
    {

        $this->middleware('guest:admin')->except('logout');
    }
    public function login()
    {
        return view('admin.auth.login');
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('dashboard.login');
    }
    public function checkLogin(CheckLoginRequest $request)
    {

        if (Auth::guard('admin')->attempt($request->only('email', 'password'),true)) {
            Auth::guard('web')->logout();
            $request->session()->regenerate();

            $this->clearLoginAttempts($request);
            return redirect()->intended($this->redirectTo);

        } else {
            return redirect()->back()->withInput(['email' => $request->email])->withErrors(['error' => __('these credentials do not match our records')]);
        }
    }
    protected function guard()
    {
        return Auth::guard('admin');
    }
}
