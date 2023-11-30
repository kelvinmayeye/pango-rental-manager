<?php

namespace App\Http\Controllers\Auth;

use App\Models\Users\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthenticationController extends Controller
{
    public function authenticate(Request $request)
    {
        $user = User::whereEmail($request->email)->first();
        if(!$user){
            Session::flash('error', 'The entered email or password is invalid');
            return back();
        }
        if($user->is_active == 0){
            Session::flash('error', 'Your account is currently disabled. Please contact the administrator.');
            return back();
        }
        $credentials=[
            'email'=>$request->email,
            'password'=>$request->password,
        ];
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        } else {
            Session::flash('error', 'The entered email or password is invalid');
            return back();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function getRegistration(){
        return view('auth.signup');
    }
}
