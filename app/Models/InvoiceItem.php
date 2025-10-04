<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'item_type',
        'item_code',
        'item_name',
        'description',
        'quantity',
        'unit',
        'unit_price',
        'discount_percentage',
        'discount_amount',
        'tax_rate',
        'tax_amount',
        'total_amount'
    ];

    protected $casts = [
        'quantity' => 'decimal:2',
        'unit_price' => 'decimal:2',
        'discount_percentage' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'tax_rate' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'total_amount' => 'decimal:2'
    ];

    /**
     * Relación con la factura
     */
    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    /**
     * Calcular el total del item
     */
    public function calculateTotal(): void
    {
        $subtotal = $this->quantity * $this->unit_price;
        $discountAmount = $subtotal * ($this->discount_percentage / 100);
        $taxableAmount = $subtotal - $discountAmount;
        $taxAmount = $taxableAmount * ($this->tax_rate / 100);
        $totalAmount = $taxableAmount + $taxAmount;

        $this->update([
            'discount_amount' => $discountAmount,
            'tax_amount' => $taxAmount,
            'total_amount' => $totalAmount
        ]);
    }

    /**
     * Obtener el texto del tipo de item en español
     */
    public function getItemTypeTextAttribute(): string
    {
        return match($this->item_type) {
            'service' => 'Servicio',
            'product' => 'Producto',
            'part' => 'Repuesto',
            default => 'Otro'
        };
    }

    /**
     * Obtener el color del badge según el tipo
     */
    public function getItemTypeBadgeColorAttribute(): string
    {
        return match($this->item_type) {
            'service' => 'primary',
            'product' => 'success',
            'part' => 'warning',
            default => 'secondary'
        };
    }

    /**
     * Scope para servicios
     */
    public function scopeServices($query)
    {
        return $query->where('item_type', 'service');
    }

    /**
     * Scope para productos
     */
    public function scopeProducts($query)
    {
        return $query->where('item_type', 'product');
    }

    /**
     * Scope para repuestos
     */
    public function scopeParts($query)
    {
        return $query->where('item_type', 'part');
    }
}