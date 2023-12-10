<?php
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