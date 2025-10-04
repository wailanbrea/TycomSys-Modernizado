<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EquipmentStatus extends Model
{
    protected $fillable = [
        'repair_equipment_id',
        'status',
        'description',
        'notes',
        'updated_by',
        'status_date'
    ];

    protected $casts = [
        'status_date' => 'datetime'
    ];

    // Relaciones
    public function repairEquipment(): BelongsTo
    {
        return $this->belongsTo(RepairEquipment::class);
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
