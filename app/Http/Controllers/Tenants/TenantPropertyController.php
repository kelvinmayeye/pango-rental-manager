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
        $tenantProperties = TenantProperty::join( 'properties', 'tenant_properties.property_id', '=', 'properties.id' )
        ->join( 'tenants', 'tenant_properties.tenant_id', '=', 'tenants.id' )
        ->where( 'properties.user_id', auth()->user()->id )
        ->select( 'tenant_properties.*') // Select the fullname column
        ->get();

        // return $tenantProperties;
        return view( 'backend.tenantProperties.index', compact( 'tenantProperties' ) );
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
        } catch ( QueryException $exception ) {
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

    public function activateTenantProperty($id){
        $tenantProperty = TenantProperty::find($id);
        if(!$tenantProperty){
            Session::flash('error', 'Invalid tenant property');
            return back();
        }
        if ($tenantProperty->is_active == 0) {
            $tenantProperty->is_active = 1;
            $tenantProperty->save();
            Session::flash('success', 'Tenant property status changed');
            return back();
        } else {
            $tenantProperty->is_active = 0;
            $tenantProperty->save();
            Session::flash('success', 'Tenant property status changed');
            return back();
        }

    }
}
