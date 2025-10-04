<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RepairEquipment extends Model
{
    protected $fillable = [
        'ticket_number',
        'customer_name',
        'customer_phone',
        'customer_email',
        'serial_number',
        'problem_description',
        'accessories',
        'notes',
        'estimated_cost',
        'final_cost',
        'status',
        'assigned_technician_id',
        'created_by',
        'received_at',
        'estimated_delivery',
        'delivered_at',
        'brand_id',
        'type_id',
        'model_id'
    ];

    protected $casts = [
        'received_at' => 'datetime',
        'estimated_delivery' => 'datetime',
        'delivered_at' => 'datetime',
        'estimated_cost' => 'decimal:2',
        'final_cost' => 'decimal:2'
    ];

        // Relaciones
        public function assignedTechnician(): BelongsTo
        {
            return $this->belongsTo(User::class, 'assigned_technician_id');
        }

        public function createdBy(): BelongsTo
        {
            return $this->belongsTo(User::class, 'created_by');
        }

        public function statusHistory(): HasMany
        {
            return $this->hasMany(EquipmentStatus::class);
        }

        public function brand(): BelongsTo
        {
            return $this->belongsTo(EquipmentBrand::class, 'brand_id');
        }

        public function type(): BelongsTo
        {
            return $this->belongsTo(EquipmentType::class, 'type_id');
        }

        public function model(): BelongsTo
        {
            return $this->belongsTo(EquipmentModel::class, 'model_id');
        }

        public function tickets(): HasMany
        {
            return $this->hasMany(Ticket::class);
        }

    // Métodos helper
    public function getStatusBadgeColor(): string
    {
        return match($this->status) {
            'received' => 'primary',
            'in_review' => 'warning',
            'in_repair' => 'info',
            'waiting_parts' => 'secondary',
            'ready' => 'success',
            'delivered' => 'dark',
            'cancelled' => 'danger',
            default => 'secondary'
        };
    }

    public function getStatusText(): string
    {
        return match($this->status) {
            'received' => 'Recibido',
            'in_review' => 'En Revisión',
            'in_repair' => 'En Reparación',
            'waiting_parts' => 'Esperando Repuestos',
            'ready' => 'Listo',
            'delivered' => 'Entregado',
            'cancelled' => 'Cancelado',
            default => 'Desconocido'
        };
    }

    // Generar número de ticket único
    public static function generateTicketNumber(): string
    {
        do {
            $ticketNumber = 'REP-' . date('Y') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
        } while (self::where('ticket_number', $ticketNumber)->exists());

        return $ticketNumber;
    }

    /**
     * Relación con facturas
     */
    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }
}
