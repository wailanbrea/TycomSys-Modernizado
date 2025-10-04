<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InventoryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'sku',
        'name',
        'description',
        'category',
        'brand',
        'model',
        'compatible_equipment',
        'current_stock',
        'minimum_stock',
        'maximum_stock',
        'unit',
        'cost_price',
        'selling_price',
        'markup_percentage',
        'supplier_name',
        'supplier_contact',
        'supplier_phone',
        'supplier_email',
        'location_aisle',
        'location_shelf',
        'location_position',
        'is_active',
        'low_stock_alert',
        'last_restocked',
        'last_used',
        'notes',
        'barcode',
        'qr_code',
    ];

    protected $casts = [
        'cost_price' => 'decimal:2',
        'selling_price' => 'decimal:2',
        'markup_percentage' => 'decimal:2',
        'is_active' => 'boolean',
        'low_stock_alert' => 'boolean',
        'last_restocked' => 'date',
        'last_used' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();

        // Generar SKU automáticamente si no se proporciona
        static::creating(function ($item) {
            if (empty($item->sku)) {
                $item->sku = self::generateSKU($item->category);
            }
        });

        // Actualizar alerta de stock bajo
        static::saving(function ($item) {
            $item->low_stock_alert = $item->current_stock <= $item->minimum_stock;
        });
    }

    /**
     * Relación con movimientos de inventario
     */
    public function movements(): HasMany
    {
        return $this->hasMany(InventoryMovement::class);
    }

    /**
     * Generar SKU único
     */
    public static function generateSKU($category = 'PART'): string
    {
        $prefix = strtoupper(substr($category, 0, 3));
        $counter = self::where('sku', 'like', $prefix . '%')->count() + 1;
        
        do {
            $sku = $prefix . '-' . str_pad($counter, 4, '0', STR_PAD_LEFT);
            $counter++;
        } while (self::where('sku', $sku)->exists());

        return $sku;
    }

    /**
     * Verificar si el stock está bajo
     */
    public function isLowStock(): bool
    {
        return $this->current_stock <= $this->minimum_stock;
    }

    /**
     * Verificar si el stock está agotado
     */
    public function isOutOfStock(): bool
    {
        return $this->current_stock <= 0;
    }

    /**
     * Obtener el estado del stock
     */
    public function getStockStatus(): string
    {
        if ($this->isOutOfStock()) {
            return 'out_of_stock';
        } elseif ($this->isLowStock()) {
            return 'low_stock';
        } else {
            return 'in_stock';
        }
    }

    /**
     * Obtener el color del badge según el estado del stock
     */
    public function getStockStatusColor(): string
    {
        return match($this->getStockStatus()) {
            'out_of_stock' => 'danger',
            'low_stock' => 'warning',
            'in_stock' => 'success',
            default => 'secondary'
        };
    }

    /**
     * Obtener el texto del estado del stock
     */
    public function getStockStatusText(): string
    {
        return match($this->getStockStatus()) {
            'out_of_stock' => 'Agotado',
            'low_stock' => 'Stock Bajo',
            'in_stock' => 'En Stock',
            default => 'Desconocido'
        };
    }

    /**
     * Calcular el margen de ganancia
     */
    public function calculateMarkup(): float
    {
        if ($this->cost_price > 0) {
            return (($this->selling_price - $this->cost_price) / $this->cost_price) * 100;
        }
        return 0;
    }

    /**
     * Actualizar el stock
     */
    public function updateStock(int $quantity, string $movementType, string $reason = null, $referenceType = null, $referenceId = null, $performedBy = null): InventoryMovement
    {
        $stockBefore = $this->current_stock;
        
        if ($movementType === 'in' || $movementType === 'adjustment') {
            $this->current_stock += $quantity;
        } elseif ($movementType === 'out') {
            $this->current_stock -= $quantity;
        }
        
        $this->save();
        
        // Crear movimiento de inventario
        return $this->movements()->create([
            'movement_type' => $movementType,
            'quantity' => $quantity,
            'stock_before' => $stockBefore,
            'stock_after' => $this->current_stock,
            'reference_type' => $referenceType,
            'reference_id' => $referenceId,
            'reason' => $reason,
            'performed_by' => $performedBy ?? auth()->id(),
            'movement_date' => now(),
        ]);
    }

    /**
     * Obtener el historial de movimientos recientes
     */
    public function getRecentMovements(int $limit = 10)
    {
        return $this->movements()
            ->with('performedBy')
            ->orderBy('movement_date', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Scope para items con stock bajo
     */
    public function scopeLowStock($query)
    {
        return $query->whereRaw('current_stock <= minimum_stock');
    }

    /**
     * Scope para items activos
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope para buscar por SKU o nombre
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('sku', 'like', "%{$search}%")
              ->orWhere('name', 'like', "%{$search}%")
              ->orWhere('brand', 'like', "%{$search}%")
              ->orWhere('model', 'like', "%{$search}%");
        });
    }
}