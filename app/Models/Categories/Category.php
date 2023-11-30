<?php

namespace App\Models\Categories;

use App\Models\Properties\Property;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    public function properties():HasMany
    {
        return $this->hasMany(Property::class);
    }
}
