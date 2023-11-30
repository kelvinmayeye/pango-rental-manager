<?php

namespace App\Models\Tenants;

use App\Models\Payments\Payment;
use App\Models\Tenants\TenantProperty;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tenant extends Model
{
    use HasFactory, SoftDeletes;

    public function tenantProperties():HasMany
    {
        return $this->hasMany(TenantProperty::class);
    }

    public function payments():HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
