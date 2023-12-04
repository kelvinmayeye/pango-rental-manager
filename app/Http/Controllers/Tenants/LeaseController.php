<?php

namespace App\Http\Controllers\Tenants;

use App\Models\Leases\Lease;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tenants\TenantProperty;
use Illuminate\Support\Facades\Session;

class LeaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $leases = Lease::whereHas('tenantProperty.property.user', function ($query) {
            $query->where('id', auth()->user()->id);
        })->paginate(10);

        return view('backend.leases.index',compact('leases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $userID = auth()->user()->id;
        $tenantProperties = TenantProperty::whereHas('property', function ($query) use ($userID) {
            $query->where('user_id', $userID);
        })->where(function ($query) {
            $query->doesntHave('leases')
                ->orWhereHas('leases', function ($subQuery) {
                    $subQuery->where('status_id', 3);
                });
        })->get();

        return view('backend.leases.create',compact('tenantProperties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $lease = new Lease();
        $lease->start_date = $request->start_date;
        $lease->end_date = $request->end_date;
        $lease->monthly_rate = $request->monthly_rate;
        $lease->tenant_property_id = $request->tenant_property_id;
        $lease->status_id = 1;
        $lease->save();
        Session::flash( 'success', 'Lease successfully created' );
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Lease $lease)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lease $lease)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lease $lease)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lease = Lease::find( $id );
        if ( !$lease ) {
            Session::flash( 'error', 'Lease not found' );
            return back();
        }
        if ( $lease->payments->isEmpty() ) {
            Session::flash( 'error', 'Can\'t delete lease has payment' );
            return back();
        } else {
            try {
                $lease->delete();
                Session::flash( 'success', 'Lease deleted successfully' );
                return redirect()->route( 'leases.index' );
            } catch ( QueryException $exception ) {
                Session::flash( 'error', 'Failed to be deleted' );
                return back();
            }
        }
    }
}
