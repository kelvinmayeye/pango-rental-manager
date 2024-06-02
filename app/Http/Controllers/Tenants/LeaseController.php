<?php

namespace App\Http\Controllers\Tenants;

use App\Models\Leases\Lease;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tenants\TenantProperty;
use Illuminate\Support\Facades\Session;

class LeaseController extends Controller
{

    public function index()
    {
        $leases = Lease::whereHas('tenantProperty.property.user', function ($query) {
            $query->where('id', auth()->user()->id);
        })->paginate(10);

        return view('backend.leases.index',compact('leases'));
    }

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

    public function store(Request $request)
    {
        //Todo: implement try and catch and statuses check
        $lease = new Lease();
        $lease->start_date = $request->start_date;
        $lease->end_date = $request->end_date;
        $lease->monthly_rate = $request->monthly_rate;
        $lease->tenant_property_id = $request->tenant_property_id;
        $lease->status_id = 1;
        $lease->save();
        Session::flash( 'success', 'Lease successfully created' );
        return redirect()->route('leases.index');
    }

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
