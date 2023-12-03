<?php

namespace App\Http\Controllers\Tenants;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Tenants\TenantProperty;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;

class TenantPropertyController extends Controller {
    /**
    * Display a listing of the resource.
    */

    public function index() {
        $tenantProperties = DB::table( 'tenant_properties' )
        ->join( 'properties', 'tenant_properties.property_id', '=', 'properties.id' )
        ->where( 'properties.user_id', auth()->user()->id )
        ->paginate(10);
        return view('backend.tenantProperties.index',compact('tenantProperties'));
    }

    /**
    * Show the form for creating a new resource.
    */

    public function create() {
        //
    }

    /**
    * Store a newly created resource in storage.
    */

    public function store( Request $request ) {
        $tenantProperty = new TenantProperty();
        $tenantProperty->tenant_id = $request->tenant_id;
        $tenantProperty->property_id = $request->property_id;
        try {
            $tenantProperty->save();
            Session::flash( 'success', 'Tenant property successfully added' );
            return back();
        } catch (QueryException $exception) {
            Session::flash( 'error', 'Failed to add' );
            return back();
        }
    }

    /**
    * Display the specified resource.
    */

    public function show( TenantProperty $tenantProperty ) {
        //
    }

    /**
    * Show the form for editing the specified resource.
    */

    public function edit( TenantProperty $tenantProperty ) {
        //
    }

    /**
    * Update the specified resource in storage.
    */

    public function update( Request $request, TenantProperty $tenantProperty ) {
        //
    }

    /**
    * Remove the specified resource from storage.
    */

    public function destroy( TenantProperty $tenantProperty ) {
        //
    }
}
