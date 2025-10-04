<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EquipmentBrand extends Model
{
    protected $fillable = [
        'name',
        'display_name',
        'description',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    // Relaciones
    public function models(): HasMany
    {
        return $this->hasMany(EquipmentModel::class, 'brand_id');
    }

    public function repairEquipments(): HasMany
    {
        return $this->hasMany(RepairEquipment::class, 'brand_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Accessors
    public function getDisplayNameAttribute($value)
    {
        return $value ?: $this->name;
    }
}