<?php

use App\Models\Tenants\TenantProperty;
use Carbon\Carbon;
use App\Models\Leases\Lease;
use App\Models\Payments\Payment;
use Illuminate\Support\Facades\DB;

function calculateTotalLeasePaid( $id ) {
    $totalPaid = Payment::where( 'lease_id', $id )->sum( 'amount' );
    return $totalPaid;
}

function leaseBalance( $id ) {
    $lease = Lease::find( $id );
    if ( !$lease ) {

        return 0;
    }
    $startDate = Carbon::parse( $lease->start_date );
    $endDate = Carbon::parse( $lease->end_date );
    $totalMonths = $endDate->diffInMonths( $startDate );

    $amount = $totalMonths * $lease->monthly_rate;
    $balance = $amount - calculateTotalLeasePaid( $id );

    return $balance;
}

function daysRemaining($id) {
    $lease = Lease::find($id);

    if (!$lease) {
        return 0;
    }

    $endDate = Carbon::parse($lease->end_date);
    if ($endDate->isPast()) {
        return 0;
    }

    $remainingDays = $endDate->diffInDays(Carbon::now());

    return $remainingDays;
}

function getLeaseStatus( $LeaseId ) {
    $leaseBalance = leaseBalance( $LeaseId );
    if ( $leaseBalance <= 0 ) {
        return 2;
    }else{
        return 4;
    }
}

function tenantLeasesCount($id){
    return Lease::whereHas('tenantProperty', function ($query) use ($id) {
        $query->where('tenant_id', $id);
    })->count();
}

function tenantPropertyCount($id){
    $tenantProperty = TenantProperty::where('tenant_id',$id)->where('is_active',1)->get()->count();
    return $tenantProperty;
}

function tenantLastPayment($id){
    $payment = Payment::where('tenant_id', $id)->latest()->first('amount');
    if ($payment) {
        return $payment->amount;
    } else {
        return 'No Payment';
    }
}
