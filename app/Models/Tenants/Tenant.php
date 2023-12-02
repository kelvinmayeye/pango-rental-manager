<?php

namespace App\Models\Tenants;

use App\Models\Payments\Payment;
use App\Models\Tenants\TenantProperty;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tenant extends Model {
    use HasFactory, SoftDeletes;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tenantProperties():HasMany {
        return $this->hasMany( TenantProperty::class );
    }

    public function payments():HasMany {
        return $this->hasMany( Payment::class );
    }

    public function getFullnameAttribute() {
        return $this->attributes[ 'first_name' ].' '.' '.$this->attributes[ 'middle_name' ].' '.$this->attributes[ 'last_name' ];
    }

    public function getAgeAttribute() {
        $birthDate = $this->attributes[ 'birth_date' ];
        $today = date( 'Y-m-d' );
        $diff = date_diff( date_create( $birthDate ), date_create( $today ) );
        return $diff->y;
    }
}
