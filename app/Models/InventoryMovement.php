<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InventoryMovement extends Model
{
    use HasFactory;

    protected $fillable = [
        'inventory_item_id',
        'movement_type',
        'quantity',
        'stock_before',
        'stock_after',
        'reference_type',
        'reference_id',
        'reference_number',
        'reason',
        'notes',
        'performed_by',
        'unit_cost',
        'total_cost',
        'movement_date',
    ];

    protected $casts = [
        'unit_cost' => 'decimal:2',
        'total_cost' => 'decimal:2',
        'movement_date' => 'datetime',
    ];

    /**
     * Relación con el item de inventario
     */
    public function inventoryItem(): BelongsTo
    {
        return $this->belongsTo(InventoryItem::class);
    }

    /**
     * Relación con el usuario que realizó el movimiento
     */
    public function performedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'performed_by');
    }

    /**
     * Obtener el tipo de movimiento en español
     */
    public function getMovementTypeText(): string
    {
        return match($this->movement_type) {
            'in' => 'Entrada',
            'out' => 'Salida',
            'adjustment' => 'Ajuste',
            'transfer' => 'Transferencia',
            'return' => 'Devolución',
            default => 'Desconocido'
        };
    }

    /**
     * Obtener el color del badge según el tipo de movimiento
     */
    public function getMovementTypeColor(): string
    {
        return match($this->movement_type) {
            'in' => 'success',
            'out' => 'danger',
            'adjustment' => 'warning',
            'transfer' => 'info',
            'return' => 'primary',
            default => 'secondary'
        };
    }

    /**
     * Obtener el ícono según el tipo de movimiento
     */
    public function getMovementTypeIcon(): string
    {
        return match($this->movement_type) {
            'in' => 'fas fa-arrow-up',
            'out' => 'fas fa-arrow-down',
            'adjustment' => 'fas fa-edit',
            'transfer' => 'fas fa-exchange-alt',
            'return' => 'fas fa-undo',
            default => 'fas fa-question'
        };
    }

    /**
     * Verificar si es un movimiento de entrada
     */
    public function isInbound(): bool
    {
        return in_array($this->movement_type, ['in', 'adjustment', 'return']);
    }

    /**
     * Verificar si es un movimiento de salida
     */
    public function isOutbound(): bool
    {
        return in_array($this->movement_type, ['out', 'transfer']);
    }

    /**
     * Obtener la cantidad con signo
     */
    public function getSignedQuantity(): int
    {
        return $this->isInbound() ? abs($this->quantity) : -abs($this->quantity);
    }

    /**
     * Scope para movimientos de entrada
     */
    public function scopeInbound($query)
    {
        return $query->whereIn('movement_type', ['in', 'adjustment', 'return']);
    }

    /**
     * Scope para movimientos de salida
     */
    public function scopeOutbound($query)
    {
        return $query->whereIn('movement_type', ['out', 'transfer']);
    }

    /**
     * Scope para un rango de fechas
     */
    public function scopeDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('movement_date', [$startDate, $endDate]);
    }

    /**
     * Scope para un tipo específico de movimiento
     */
    public function scopeByType($query, $type)
    {
        return $query->where('movement_type', $type);
    }

    /**
     * Scope para movimientos relacionados con una referencia
     */
    public function scopeByReference($query, $type, $id)
    {
        return $query->where('reference_type', $type)
                    ->where('reference_id', $id);
    }
}