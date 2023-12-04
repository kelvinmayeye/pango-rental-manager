<?php

namespace App\Http\Controllers\Tenants;

use Illuminate\Http\Request;
use App\Models\Tenants\Tenant;
use App\Models\Properties\Property;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;

class TenantController extends Controller {
    /**
    * Display a listing of the resource.
    */

    public function index() {
        $tenants = Tenant::latest()->paginate( 10 );
        return view( 'backend.tenants.index', compact( 'tenants' ) );
    }

    /**
    * Show the form for creating a new resource.
    */

    public function create() {
        return view( 'backend.tenants.create' );
    }

    /**
    * Store a newly created resource in storage.
    */

    public function store( Request $request ) {
        $tenant = new Tenant();
        $tenant->first_name = $request->first_name;
        $tenant->middle_name = $request->middle_name;
        $tenant->last_name = $request->last_name;
        $tenant->sex = $request->sex;
        $tenant->birth_date = $request->birth_date;
        $tenant->email = $request->email;
        $tenant->phone_number = $request->phone_number;
        $tenant->occupation = $request->occupation;
        $tenant->user_id = auth()->user()->id;
        try {
            $tenant->save();
            Session::flash( 'success', 'Tenant successfully added' );
            return redirect()->route( 'tenants.index' );
        } catch ( QueryException $exception ) {
            Session::flash( 'error', 'Failed to add tenant' );
            return back();
        }
    }

    /**
    * Display the specified resource.
    */

    public function show( Tenant $tenant ) {
        $tenant = Tenant::find($tenant->id);
        if(!$tenant){
            Session::flash( 'error', 'Tenant not found' );
            return back();
        }
        $properties = Property::where('user_id', auth()->user()->id)->where(function ($query) {
        $query->whereHas('tenantProperties', function ($subQuery) {
                $subQuery->where('is_active', 1); // left property tenant (whats owed)
            })->orWhereDoesntHave('tenantProperties');
        })->latest()->get();

        return view('backend.tenants.show',compact('tenant','properties'));
    }

    /**
    * Show the form for editing the specified resource.
    */

    public function edit( string $id ) {
        $tenant = Tenant::find($id);
        if(!$tenant){
            Session::flash( 'error', 'Tenant not found' );
            return back();
        }
        return view('backend.tenants.edit',compact('tenant'));
    }

    /**
    * Update the specified resource in storage.
    */

    public function update( Request $request, string $id ) {
        $tenant = Tenant::find($id);
        if(!$tenant){
            Session::flash( 'error', 'Tenant not found' );
            return back();
        }

        $tenant->first_name = $request->first_name;
        $tenant->middle_name = $request->middle_name;
        $tenant->last_name = $request->last_name;
        $tenant->sex = $request->sex;
        $tenant->birth_date = $request->birth_date;
        $tenant->email = $request->email;
        $tenant->occupation = $request->occupation;
        $tenant->phone_number = $request->phone_number;
        try {
            $tenant->save();
            Session::flash( 'success', 'Tenant successfully updated' );
            return back();
        } catch (QueryException $exception) {
            Session::flash( 'error', 'Failed to delete' );
            return back();
        }

    }

    /**
    * Remove the specified resource from storage.
    */

    public function destroy( string $id ) {
        $tenant = Tenant::find($id);
        if(!$tenant){
            Session::flash( 'error', 'Tenant not found' );
            return back();
        }
        if ($tenant->tenantProperties->isEmpty() && $tenant->payments->isEmpty()) {
            try {
                $tenant->delete();
                Session::flash('success', 'Tenant deleted successfully');
                return redirect()->route('tenants.index');
            } catch (QueryException $exception) {
                Session::flash('error', 'Failed to be deleted');
                return back();
            }
            // Perform any additional actions or redirection as needed
        } else {
            Session::flash('error', 'Cant delete tenant has property and payment');
            return back();
        }
    }
}
