<?php

namespace App\Http\Controllers\Users;

use App\Models\Users\User;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class UserController extends Controller {
    /**
    * Display a listing of the resource.
    */

    public function index() {
        $users = User::latest()->paginate( 10 );
        return view( 'backend.users.index', compact( 'users' ) );
    }

    /**
    * Show the form for creating a new resource.
    */

    public function create() {
        return view( 'backend.users.create' );
    }

    /**
    * Store a newly created resource in storage.
    */

    public function store( Request $request ) {
        $this->validate( $request, [
            'first_name'=>'required|max:30',
            'middle_name'=>'nullable|max:30',
            'last_name'=>'required|max:30',
            'email'=>'required|email|unique:users',
            'phone_number'=>'required|unique:users',
            'password'=>'required|min:8|confirmed'
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
            return redirect()->route( 'users.index' );
        } catch ( QueryException $exception ) {
            Session::flash( 'error', 'Failed to store user try again' );
        }
    }

    /**
    * Display the specified resource.
    */

    public function show( User $user ) {
        $user = User::find( $id );
        if ( !$user ) {
            Session::flash( 'error', 'user not found' );
            return back();
        }

        return view( 'backend.users.show' );
    }

    /**
    * Show the form for editing the specified resource.
    */

    public function edit( User $user ) {
        $user = User::find( $id );
        if ( !$user ) {
            Session::flash( 'error', 'user not found' );
            return back();
        }

        return view( 'backend.users.edit' );
    }

    /**
    * Update the specified resource in storage.
    */

    public function update( Request $request, User $user ) {
        $user = User::find( $id );
        if ( !$user ) {
            Session::flash( 'error', 'user not found' );
            return back();
        }

        $this->validate( $request, [
            'first_name'=>'required|max:30',
            'middle_name'=>'nullable|max:30',
            'last_name'=>'required|max:30',
            'email'=>'required|email|unique:users',
            'phone_number'=>'required|unique:users'
        ] );

        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;

        try {
            $user->save();
            Session::flash( 'success', 'User successfully updated' );
            return redirect()->route( 'users.index' );
        } catch ( QueryException $exception ) {
            Session::flash( 'error', 'Failed to Update User details' );
            return back();
        }

    }

    /**
    * Remove the specified resource from storage.
    */

    public function destroy( User $user ) {
        $user = User::find( $id );
        if ( !$user ) {
            Session::flash( 'error', 'user not found' );
            return back();
        }
        try {
            $user->delete();
            Session::flash( 'success', 'user deleted successfully' );
            return redirect()->route( 'users.index' );
        } catch ( QueryException $exception ) {
            Session::flash( 'error', 'Failed to be deleted' );
            return back();
        }
    }
}
