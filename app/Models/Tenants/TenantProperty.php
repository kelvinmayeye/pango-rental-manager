<?php

namespace App\Models\Tenants;

use App\Models\Leases\Lease;
use App\Models\Tenants\Tenant;
use App\Models\Properties\Property;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TenantProperty extends Model
{
    use HasFactory, SoftDeletes;

    public function properties():BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function tenants():BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function leases():HasMany
    {
        return $this->hasMany(Lease::class);
    }
}
