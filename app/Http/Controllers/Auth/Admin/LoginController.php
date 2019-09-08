<?php

namespace App\Http\Controllers\Auth\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Alert;

class LoginController extends Controller
{
    //
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.admin.login');
    }

    function postlogin(Request $request)
    {
        $login_type = filter_var($request->input('username'), FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'username';

        $request->merge([
            $login_type => $request->input('username')
        ]);

        if (Auth::attempt($request->only($login_type, 'password'))) {
            return redirect('/admin');
        } else {
            Alert::error('Gagal Menambahkan Data', 'Ooops');
            return redirect()->back()->with('gagal', 'user id/password salah');
        }
    }

    function logout()
    {
        Auth::guard('web')->logout();
        return redirect('/adminpanel');
    }
}
