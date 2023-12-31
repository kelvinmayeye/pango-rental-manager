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

function daysRemaining( $id ) {
    $lease = Lease::find( $id );

    if ( !$lease ) {

        return Carbon::now();
    }

    $endDate = Carbon::parse( $lease->end_date );
    $remainingDays = $endDate->diffInDays( Carbon::now() );

    return $remainingDays;
}

function getLeaseStatus( $LeaseId, $payment ) {
    $amount = calculateTotalLeasePaid( $LeaseId );
    $result = $amount - $payment;
    if ( $result == 0 ) {
        return $result;
    } elseif ( $result < $amount ) { // partial paid
        return 1;
    }else{
        return 2; // overpaid
    }
}