<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    protected $fillable = [
        'ticket_number',
        'repair_equipment_id',
        'title',
        'description',
        'priority',
        'status',
        'assigned_technician_id',
        'created_by',
        'due_date',
        'resolved_at',
        'resolution_notes'
    ];

    protected $casts = [
        'due_date' => 'datetime',
        'resolved_at' => 'datetime'
    ];

    // Relaciones
    public function repairEquipment(): BelongsTo
    {
        return $this->belongsTo(RepairEquipment::class);
    }

    public function assignedTechnician(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_technician_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Comentarios de tickets (si se implementa en el futuro)
    // public function comments(): HasMany
    // {
    //     return $this->hasMany(TicketComment::class);
    // }

    // Scopes
    public function scopeOpen($query)
    {
        return $query->whereIn('status', ['open', 'in_progress', 'waiting_customer', 'waiting_parts']);
    }

    public function scopeClosed($query)
    {
        return $query->whereIn('status', ['resolved', 'closed', 'cancelled']);
    }

    public function scopeByPriority($query, $priority)
    {
        return $query->where('priority', $priority);
    }

    public function scopeAssignedTo($query, $technicianId)
    {
        return $query->where('assigned_technician_id', $technicianId);
    }

    // Métodos helper
    public function getPriorityBadgeColor(): string
    {
        return match($this->priority) {
            'low' => 'secondary',
            'medium' => 'primary',
            'high' => 'warning',
            'urgent' => 'danger',
            default => 'secondary'
        };
    }

    public function getPriorityText(): string
    {
        return match($this->priority) {
            'low' => 'Baja',
            'medium' => 'Media',
            'high' => 'Alta',
            'urgent' => 'Urgente',
            default => 'Desconocida'
        };
    }

    public function getStatusBadgeColor(): string
    {
        return match($this->status) {
            'open' => 'primary',
            'in_progress' => 'info',
            'waiting_customer' => 'warning',
            'waiting_parts' => 'secondary',
            'resolved' => 'success',
            'closed' => 'dark',
            'cancelled' => 'danger',
            default => 'secondary'
        };
    }

    public function getStatusText(): string
    {
        return match($this->status) {
            'open' => 'Abierto',
            'in_progress' => 'En Progreso',
            'waiting_customer' => 'Esperando Cliente',
            'waiting_parts' => 'Esperando Repuestos',
            'resolved' => 'Resuelto',
            'closed' => 'Cerrado',
            'cancelled' => 'Cancelado',
            default => 'Desconocido'
        };
    }

    // Generar número de ticket único
    public static function generateTicketNumber(): string
    {
        do {
            $ticketNumber = 'TIC-' . date('Y') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
        } while (self::where('ticket_number', $ticketNumber)->exists());

        return $ticketNumber;
    }

    // Marcar como resuelto
    public function markAsResolved($notes = null)
    {
        $this->update([
            'status' => 'resolved',
            'resolved_at' => now(),
            'resolution_notes' => $notes
        ]);
    }
}