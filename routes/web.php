<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReactController;
use App\Http\Controllers\TicomsysController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TecnicoController;
use App\Http\Controllers\RepairEquipmentController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\SystemConfigController;
use App\Http\Controllers\CustomerQueryController;

// API routes para Laravel
Route::prefix('api')->group(function () {
    // Health check
    Route::get('/health', function () {
        return response()->json(['status' => 'OK', 'message' => 'Laravel API funcionando correctamente']);
    });
    
    // Test endpoint para técnicos (temporal para debug)
    Route::get('/test/technicians', function () {
        $technicians = \App\Models\User::whereHas('roles', function($query) {
            $query->where('name', 'tecnico');
        })->select('id', 'name', 'email')->get();
        return response()->json(['technicians' => $technicians]);
    });
    
    // Endpoints públicos para marcas, tipos, modelos y técnicos
    Route::get('/public/brands', function () {
        $brands = \App\Models\EquipmentBrand::all();
        return response()->json(['brands' => $brands]);
    });
    
    Route::get('/public/types', function () {
        $types = \App\Models\EquipmentType::all();
        return response()->json(['types' => $types]);
    });
    
    Route::get('/public/models', function () {
        $models = \App\Models\EquipmentModel::with(['brand', 'type'])->get();
        return response()->json(['models' => $models]);
    });
    
    Route::get('/public/repair-equipment/create', function () {
        $technicians = \App\Models\User::whereHas('roles', function($query) {
            $query->where('name', 'tecnico');
        })->select('id', 'name', 'email')->get();
        return response()->json(['technicians' => $technicians]);
    });
    
    Route::get('/public/equipments', function () {
        $equipments = \App\Models\RepairEquipment::with(['assignedTechnician', 'createdBy', 'brand', 'type', 'model'])
            ->orderBy('created_at', 'desc')
            ->get();
        return response()->json(['data' => $equipments]);
    });
    
    
    // API de usuarios (solo para admins)
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/users', [AdminController::class, 'getUsers']);
        Route::get('/roles', [AdminController::class, 'getRoles']);
        Route::post('/roles', [AdminController::class, 'storeRole']);
        Route::put('/roles/{id}', [AdminController::class, 'updateRole']);
        Route::delete('/roles/{id}', [AdminController::class, 'destroyRole']);
        Route::get('/permissions', [AdminController::class, 'getPermissions']);
        Route::post('/users/{user}/assign-role', [AdminController::class, 'assignRole']);
        Route::delete('/users/{user}/remove-role/{role}', [AdminController::class, 'removeRole']);
    });
    
    // API de técnico
    Route::middleware(['auth', 'role:tecnico'])->group(function () {
        Route::get('/equipment', [TecnicoController::class, 'getEquipment']);
        Route::get('/tickets', [TecnicoController::class, 'getTickets']);
        Route::get('/reports', [TecnicoController::class, 'getReports']);
    });
    
        // API de equipos de reparación
        Route::middleware(['auth'])->group(function () {
            Route::apiResource('repair-equipment', RepairEquipmentController::class);
            Route::get('/repair-equipment/create', [RepairEquipmentController::class, 'create']);
            Route::post('/repair-equipment/{id}/update-status', [RepairEquipmentController::class, 'updateStatus']);
            Route::get('/repair-equipment/ticket/{ticketNumber}', [RepairEquipmentController::class, 'getByTicketNumber']);
        });
        
        // API de tickets
        Route::middleware(['auth'])->group(function () {
            Route::apiResource('tickets', TicketController::class);
            Route::post('/tickets/{id}/update-status', [TicketController::class, 'updateStatus']);
            Route::get('/tickets/status/{status}', [TicketController::class, 'getByStatus']);
            Route::get('/tickets/technician/{technicianId}', [TicketController::class, 'getAssignedToTechnician']);
        });
        
        // API de facturas
        Route::middleware(['auth'])->group(function () {
            Route::apiResource('invoices', InvoiceController::class);
            Route::post('/invoices/{id}/mark-paid', [InvoiceController::class, 'markAsPaid']);
            Route::get('/invoices/status/{status}', [InvoiceController::class, 'getByStatus']);
            Route::get('/invoices/overdue', [InvoiceController::class, 'getOverdue']);
            Route::post('/invoices/create-from-equipment/{equipmentId}', [InvoiceController::class, 'createFromEquipment']);
        });
        
        // API de reportes
        Route::middleware(['auth'])->group(function () {
            Route::get('/reports/equipment-by-status', [ReportController::class, 'equipmentByStatus']);
            Route::get('/reports/revenue-by-period', [ReportController::class, 'revenueByPeriod']);
            Route::get('/reports/technician-productivity', [ReportController::class, 'technicianProductivity']);
            Route::get('/reports/most-repaired-equipment', [ReportController::class, 'mostRepairedEquipment']);
            Route::get('/reports/average-repair-time', [ReportController::class, 'averageRepairTime']);
            Route::get('/reports/financial-report', [ReportController::class, 'financialReport']);
            Route::get('/reports/dashboard-stats', [ReportController::class, 'dashboardStats']);
            Route::post('/reports/export-pdf', [ReportController::class, 'exportToPdf']);
        });
        
        // API de inventario
        Route::middleware(['auth'])->group(function () {
            Route::apiResource('inventory', InventoryController::class);
            Route::post('/inventory/{id}/update-stock', [InventoryController::class, 'updateStock']);
            Route::get('/inventory-movements', [InventoryController::class, 'getMovements']);
            Route::get('/inventory/low-stock', [InventoryController::class, 'getLowStockItems']);
            Route::get('/inventory/stats', [InventoryController::class, 'getStats']);
            Route::get('/inventory/search', [InventoryController::class, 'search']);
            Route::get('/inventory/for-repair', [InventoryController::class, 'getItemsForRepair']);
        });
        
        // API de configuración del sistema
        Route::middleware(['auth', 'role:admin'])->group(function () {
            Route::get('/system-config', [SystemConfigController::class, 'index']);
            Route::get('/system-config/group/{group}', [SystemConfigController::class, 'getGroup']);
            Route::get('/system-config/public', [SystemConfigController::class, 'getPublic']);
            Route::get('/system-config/{key}', [SystemConfigController::class, 'show']);
            Route::post('/system-config', [SystemConfigController::class, 'store']);
            Route::put('/system-config/{key}', [SystemConfigController::class, 'update']);
            Route::post('/system-config/update-multiple', [SystemConfigController::class, 'updateMultiple']);
            Route::delete('/system-config/{key}', [SystemConfigController::class, 'destroy']);
            Route::post('/system-config/clear-cache', [SystemConfigController::class, 'clearCache']);
            Route::get('/system-config/export', [SystemConfigController::class, 'export']);
            Route::post('/system-config/import', [SystemConfigController::class, 'import']);
            
            // Configuraciones específicas
            Route::get('/system-config/company', [SystemConfigController::class, 'getCompanySettings']);
            Route::post('/system-config/company', [SystemConfigController::class, 'updateCompanySettings']);
            Route::get('/system-config/invoice', [SystemConfigController::class, 'getInvoiceSettings']);
            Route::post('/system-config/invoice', [SystemConfigController::class, 'updateInvoiceSettings']);
            // Rutas de email removidas por requerimiento
        });
});

// Ruta principal para la página moderna de TICOMSYS
Route::get('/', [TicomsysController::class, 'index'])->name('home');

// Rutas para servir el frontend React desde Render
Route::get('/admin/{any}', [ReactController::class, 'index'])->where('any', '.*');
Route::get('/admin', [ReactController::class, 'index']);

// Rutas para consulta de clientes (sin autenticación)
Route::prefix('consulta')->group(function () {
    Route::get('/', [CustomerQueryController::class, 'index'])->name('customer.query');
    Route::post('/status', [CustomerQueryController::class, 'getStatus'])->name('customer.get-status');
    Route::get('/status/{ticketNumber}', [CustomerQueryController::class, 'showStatus'])->name('customer.show-status');
    // API pública para polling del estado
    Route::get('/status/{ticketNumber}/json', [CustomerQueryController::class, 'apiStatus'])->name('customer.status-json');
});

// Rutas de autenticación
Route::get('/ticomsyslogin', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/ticomsyslogin', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Ruta protegida para el dashboard
Route::get('/dashboard', [ReactController::class, 'index'])->middleware('employee.auth')->name('dashboard');

// Rutas para Admin - Usando Argon Dashboard React
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [ReactController::class, 'index'])->name('admin.dashboard');
    Route::get('/index', [ReactController::class, 'index'])->name('admin.index');
    Route::get('/home', [ReactController::class, 'index'])->name('admin.home');
    Route::get('/users', [ReactController::class, 'index'])->middleware('permission:manage_users')->name('admin.users');
    Route::get('/roles', [ReactController::class, 'index'])->middleware('permission:manage_roles')->name('admin.roles');
    Route::get('/repair-equipment', [ReactController::class, 'index'])->middleware('permission:manage_equipment')->name('admin.repair-equipment');
    Route::get('/tickets', [ReactController::class, 'index'])->middleware('permission:manage_tickets')->name('admin.tickets');
    Route::get('/invoices', [ReactController::class, 'index'])->middleware('permission:manage_invoices')->name('admin.invoices');
    Route::get('/invoice-view', [ReactController::class, 'index'])->middleware('permission:view_invoices')->name('admin.invoice-view');
        Route::get('/reports', [ReactController::class, 'index'])->middleware('permission:view_reports')->name('admin.reports');
        Route::get('/reports-advanced', [ReactController::class, 'index'])->middleware('permission:view_reports')->name('admin.reports-advanced');
    Route::get('/{any}', [ReactController::class, 'index'])->where('any', '.*');
});

// Rutas para Técnico - Usando Argon Dashboard React
Route::prefix('tecnico')->middleware(['auth', 'role:tecnico'])->group(function () {
    Route::get('/dashboard', [ReactController::class, 'index'])->name('tecnico.dashboard');
    Route::get('/repair-equipment', [ReactController::class, 'index'])->middleware('permission:manage_equipment')->name('tecnico.repair-equipment');
    Route::get('/tickets', [ReactController::class, 'index'])->middleware('permission:manage_tickets')->name('tecnico.tickets');
    Route::get('/invoices', [ReactController::class, 'index'])->middleware('permission:manage_invoices')->name('tecnico.invoices');
    Route::get('/invoice-view', [ReactController::class, 'index'])->middleware('permission:view_invoices')->name('tecnico.invoice-view');
        Route::get('/reports', [ReactController::class, 'index'])->middleware('permission:view_reports')->name('tecnico.reports');
        Route::get('/reports-advanced', [ReactController::class, 'index'])->middleware('permission:view_reports')->name('tecnico.reports-advanced');
    Route::get('/{any}', [ReactController::class, 'index'])->where('any', '.*');
});

// Ruta específica para archivos estáticos
Route::get('/static/{path}', [ReactController::class, 'assets'])->where('path', '.*');

// Catch-all route para React Router (debe ir al final)
Route::get('/{any}', [ReactController::class, 'index'])->where('any', '.*');
