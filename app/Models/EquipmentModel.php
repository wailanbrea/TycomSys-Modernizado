<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EquipmentModel extends Model
{
    protected $fillable = [
        'brand_id',
        'type_id',
        'name',
        'display_name',
        'description',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    // Relaciones
    public function brand(): BelongsTo
    {
        return $this->belongsTo(EquipmentBrand::class, 'brand_id');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(EquipmentType::class, 'type_id');
    }

    public function repairEquipments(): HasMany
    {
        return $this->hasMany(RepairEquipment::class, 'model_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByBrand($query, $brandId)
    {
        return $query->where('brand_id', $brandId);
    }

    public function scopeByType($query, $typeId)
    {
        return $query->where('type_id', $typeId);
    }

    // Accessors
    public function getDisplayNameAttribute($value)
    {
        return $value ?: $this->name;
    }

    public function getFullNameAttribute()
    {
        return $this->brand->display_name . ' ' . $this->display_name;
    }
}