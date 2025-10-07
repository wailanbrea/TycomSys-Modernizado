<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_code',
        'customer_type',
        'first_name',
        'last_name',
        'company_name',
        'tax_id',
        'email',
        'phone',
        'mobile',
        'address',
        'city',
        'state',
        'postal_code',
        'country',
        'website',
        'notes',
        'status',
        'payment_terms',
        'credit_limit',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'credit_limit' => 'decimal:2',
        'status' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        // Generar código de cliente automáticamente si no se proporciona
        static::creating(function ($customer) {
            if (empty($customer->customer_code)) {
                $customer->customer_code = self::generateCustomerCode();
            }
        });
    }

    /**
     * Relación con facturas
     */
    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    /**
     * Relación con equipos de reparación
     */
    public function repairEquipments(): HasMany
    {
        return $this->hasMany(RepairEquipment::class);
    }

    /**
     * Relación con tickets (a través de repair_equipment)
     */
    public function tickets()
    {
        return $this->hasManyThrough(Ticket::class, RepairEquipment::class);
    }

    /**
     * Relación con el usuario que creó el cliente
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Relación con el usuario que actualizó el cliente
     */
    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Generar código de cliente único
     */
    public static function generateCustomerCode(): string
    {
        $year = date('Y');
        $lastCustomer = self::whereYear('created_at', $year)
            ->orderBy('id', 'desc')
            ->first();
        
        if ($lastCustomer) {
            $lastNumber = (int) substr($lastCustomer->customer_code, -4);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        
        return "CLI-{$year}-" . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Obtener el nombre completo del cliente
     */
    public function getFullNameAttribute(): string
    {
        if ($this->customer_type === 'company') {
            return $this->company_name;
        }
        
        return trim("{$this->first_name} {$this->last_name}");
    }

    /**
     * Obtener el nombre para mostrar
     */
    public function getDisplayNameAttribute(): string
    {
        if ($this->customer_type === 'company' && $this->company_name) {
            return $this->company_name;
        }
        
        return $this->full_name;
    }

    /**
     * Obtener total facturado al cliente
     */
    public function getTotalInvoicedAttribute(): float
    {
        return $this->invoices()->sum('total_amount');
    }

    /**
     * Obtener total pagado por el cliente
     */
    public function getTotalPaidAttribute(): float
    {
        return $this->invoices()->where('status', 'paid')->sum('total_amount');
    }

    /**
     * Obtener total pendiente del cliente
     */
    public function getTotalPendingAttribute(): float
    {
        return $this->invoices()->whereIn('status', ['draft', 'sent', 'overdue'])->sum('total_amount');
    }

    /**
     * Obtener número de reparaciones del cliente
     */
    public function getTotalRepairsAttribute(): int
    {
        return $this->repairEquipments()->count();
    }

    /**
     * Obtener historial completo del cliente
     */
    public function getHistory()
    {
        $invoices = $this->invoices()->with('items', 'repairEquipment')->latest()->get();
        $repairs = $this->repairEquipments()->with('assignedTechnician', 'brand', 'type', 'model')->latest()->get();
        $tickets = $this->tickets()->with('assignedTechnician')->latest()->get();

        return [
            'invoices' => $invoices,
            'repairs' => $repairs,
            'tickets' => $tickets,
            'stats' => [
                'total_invoiced' => $this->total_invoiced,
                'total_paid' => $this->total_paid,
                'total_pending' => $this->total_pending,
                'total_repairs' => $this->total_repairs,
                'total_tickets' => $tickets->count(),
            ]
        ];
    }

    /**
     * Scope para clientes activos
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    /**
     * Scope para clientes por tipo
     */
    public function scopeByType($query, $type)
    {
        return $query->where('customer_type', $type);
    }

    /**
     * Scope para búsqueda
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('customer_code', 'like', "%{$search}%")
              ->orWhere('first_name', 'like', "%{$search}%")
              ->orWhere('last_name', 'like', "%{$search}%")
              ->orWhere('company_name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('phone', 'like', "%{$search}%")
              ->orWhere('tax_id', 'like', "%{$search}%");
        });
    }

    /**
     * Obtener el color del badge según el estado
     */
    public function getStatusBadgeColorAttribute(): string
    {
        return $this->status ? 'success' : 'danger';
    }

    /**
     * Obtener el texto del estado
     */
    public function getStatusTextAttribute(): string
    {
        return $this->status ? 'Activo' : 'Inactivo';
    }

    /**
     * Obtener el texto del tipo de cliente
     */
    public function getTypeTextAttribute(): string
    {
        return match($this->customer_type) {
            'individual' => 'Persona Física',
            'company' => 'Empresa',
            default => 'No especificado'
        };
    }
}

