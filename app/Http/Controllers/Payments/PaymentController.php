<?php

namespace App\Http\Controllers\Payments;


use Exception;
use App\Models\Leases\Lease;
use Illuminate\Http\Request;
use App\Models\Payments\Payment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userID = auth()->user()->id;

        $payments = Payment::whereHas('lease.tenantProperty.property', function ($query) use ($userID) {
            $query->where('user_id', $userID);
        })->latest()->paginate(10);

        return view('backend.payments.index',compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $userID = auth()->user()->id;

        $leases = Lease::whereHas('tenantProperty.property', function ($query) use ($userID) {
            $query->where('user_id', $userID);
        })->where(function ($query) {
            $query->whereIn('status_id', [1, 3]);
        })->get();
        return view('backend.payments.create',compact('leases'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $lease = Lease::find($request->lease_id);
        if ( !$lease ) {
            Session::flash( 'error', 'Lease not found' );
            return back();
        }
        $payment = new Payment();
        $payment->lease_id = $request->lease_id;
        $payment->amount = $request->amount;
        $payment->tenant_id = $lease->tenantProperty->tenant->id;

        
        
        try {
            $payment->save();
            $leaseStatus = getLeaseStatus($lease->id);
            if($leaseStatus == 2){
                $lease->status_id = 2;
                $lease->save();
                Session::flash( 'success', 'Payment successfully added and Lease is fully paid' );
                return back();
            }else{
                $lease->status_id = 4;
                $lease->save();
                Session::flash( 'success', 'Payment successfully added and Lease partially paid' );
                return back();
            }
        } catch (Exception $ex) {
            Session::flash( 'error', 'Failed to add payment' );
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }

    public function getLeaseAmount(string $id){
        $lease = Lease::find($id);
        if ($lease) {
            return response()->json(['amount' => number_format($lease->monthly_rate)]);
        }else{
            return response()->json(['amount' => "No amount"]);
        }
    }
}
