<?php

namespace App\Models\Properties;

use App\Models\Users\User;
use App\Models\Categories\Category;
use App\Models\Tenants\TenantProperty;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{
    use HasFactory, SoftDeletes;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    
    public function tenantProperties():HasMany
    {
        return $this->hasMany(TenantProperty::class);
    }

    
    
}
