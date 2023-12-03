<?php

namespace App\Http\Controllers\Auth;

use App\Models\Users\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
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

    public function register(Request $request){
        if($request->password != $request->password_confirmation){
            Session::flash( 'error', 'Passwords didnt match' );
            return back();
        }
        $this->validate( $request, [
            'first_name'=>'required|max:30',
            'middle_name'=>'nullable|max:30',
            'last_name'=>'required|max:30',
            'email'=>'required|email|unique:users',
            'phone_number'=>'required|unique:users',
            'password'=>'required|confirmed'
        ] );


        $user = new User();
        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->password = bcrypt( $request->password );
        try {
            $user->save();
            Session::flash( 'success', 'successfully Registerd' );
            return redirect()->route('login');
        } catch ( QueryException $exception ) {
            Session::flash( 'error', 'Failed to store user try again' );
            return back();
        }
    }
}
