<?php

namespace App\Models\Leases;

use App\Models\Payments\Payment;
use App\Models\Tenants\TenantProperty;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lease extends Model
{
    use HasFactory, SoftDeletes;

    public function tenantProperty(): BelongsTo
    {
        return $this->belongsTo(TenantProperty::class);
    }

    public function payments():HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
