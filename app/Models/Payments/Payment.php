<?php

namespace App\Models\Payments;

use App\Models\Leases\Lease;
use App\Models\Tenants\Tenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function lease():BelongTo
    {
        return $this->belongsTo(Lease::class);
    }
}
