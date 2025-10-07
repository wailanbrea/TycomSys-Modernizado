<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\InventoryItem;
use App\Models\InventoryMovement;
use App\Http\Controllers\InventoryController;
use Illuminate\Http\Request;

class TestInventory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:inventory';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Probar el sistema de gestión de inventario';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🧪 PROBANDO SISTEMA DE GESTIÓN DE INVENTARIO');
        $this->line('==============================================');
        
        // 1. Verificar datos básicos
        $this->testBasicData();
        
        // 2. Probar controlador
        $this->testController();
        
        // 3. Probar funcionalidades del modelo
        $this->testModelFeatures();
        
        // 4. Mostrar estadísticas
        $this->showStats();
        
        // 5. Mostrar rutas API
        $this->showApiRoutes();
    }

    private function testBasicData()
    {
        $this->info('📊 VERIFICANDO DATOS BÁSICOS');
        $this->line('----------------------------');
        
        $totalItems = InventoryItem::count();
        $activeItems = InventoryItem::active()->count();
        $lowStockItems = InventoryItem::lowStock()->active()->count();
        $outOfStockItems = InventoryItem::where('current_stock', 0)->active()->count();
        $totalMovements = InventoryMovement::count();
        
        $this->line("   ✅ Total de items: {$totalItems}");
        $this->line("   ✅ Items activos: {$activeItems}");
        $this->line("   ✅ Items con stock bajo: {$lowStockItems}");
        $this->line("   ✅ Items agotados: {$outOfStockItems}");
        $this->line("   ✅ Total de movimientos: {$totalMovements}");
        
        $this->newLine();
    }

    private function testController()
    {
        $this->info('🎮 PROBANDO CONTROLADOR');
        $this->line('----------------------');
        
        $controller = new InventoryController();
        
        try {
            // Probar obtener estadísticas
            $statsResponse = $controller->getStats(new Request());
            $stats = json_decode($statsResponse->getContent(), true);
            
            $this->line("   ✅ Estadísticas obtenidas:");
            $this->line("      • Total items: {$stats['total_items']}");
            $this->line("      • Items activos: {$stats['active_items']}");
            $this->line("      • Stock bajo: {$stats['low_stock_items']}");
            $this->line("      • Agotados: {$stats['out_of_stock_items']}");
            $this->line("      • Valor total: $" . number_format($stats['total_stock_value'], 2));
            
            // Probar obtener items con stock bajo
            $lowStockResponse = $controller->getLowStockItems();
            $lowStockItems = json_decode($lowStockResponse->getContent(), true);
            
            $this->line("   ✅ Items con stock bajo: " . count($lowStockItems));
            
            // Probar búsqueda
            $searchResponse = $controller->search(new Request(['q' => 'RAM']));
            $searchResults = json_decode($searchResponse->getContent(), true);
            
            $this->line("   ✅ Resultados de búsqueda 'RAM': " . count($searchResults));
            
        } catch (\Exception $e) {
            $this->line("   ❌ Error en controlador: " . $e->getMessage());
        }
        
        $this->newLine();
    }

    private function testModelFeatures()
    {
        $this->info('🔧 PROBANDO FUNCIONALIDADES DEL MODELO');
        $this->line('-------------------------------------');
        
        // Obtener un item para probar
        $item = InventoryItem::first();
        
        if ($item) {
            $this->line("   📦 Probando con item: {$item->name}");
            
            // Probar métodos de estado
            $this->line("   ✅ Estado del stock: " . $item->getStockStatusText());
            $this->line("   ✅ Color del badge: " . $item->getStockStatusColor());
            $this->line("   ✅ ¿Stock bajo?: " . ($item->isLowStock() ? 'Sí' : 'No'));
            $this->line("   ✅ ¿Agotado?: " . ($item->isOutOfStock() ? 'Sí' : 'No'));
            $this->line("   ✅ Margen de ganancia: " . round($item->calculateMarkup(), 2) . "%");
            
            // Probar movimientos recientes
            $recentMovements = $item->getRecentMovements(3);
            $this->line("   ✅ Movimientos recientes: " . $recentMovements->count());
            
            // Probar scopes
            $lowStockCount = InventoryItem::lowStock()->count();
            $activeCount = InventoryItem::active()->count();
            $searchCount = InventoryItem::search('SSD')->count();
            
            $this->line("   ✅ Scope lowStock: {$lowStockCount} items");
            $this->line("   ✅ Scope active: {$activeCount} items");
            $this->line("   ✅ Scope search 'SSD': {$searchCount} items");
            
        } else {
            $this->line("   ⚠️ No hay items en el inventario para probar");
        }
        
        $this->newLine();
    }

    private function showStats()
    {
        $this->info('📈 ESTADÍSTICAS DEL INVENTARIO');
        $this->line('------------------------------');
        
        // Estadísticas por categoría
        $categories = InventoryItem::active()
            ->selectRaw('category, COUNT(*) as count, SUM(current_stock) as total_stock, SUM(current_stock * cost_price) as total_value')
            ->groupBy('category')
            ->get();
        
        foreach ($categories as $category) {
            $this->line("   📂 {$category->category}:");
            $this->line("      • Items: {$category->count}");
            $this->line("      • Stock total: {$category->total_stock}");
            $this->line("      • Valor: $" . number_format($category->total_value, 2));
        }
        
        // Items con stock bajo
        $lowStockItems = InventoryItem::lowStock()->active()->get();
        if ($lowStockItems->count() > 0) {
            $this->line("   ⚠️ Items con stock bajo:");
            foreach ($lowStockItems as $item) {
                $this->line("      • {$item->name}: {$item->current_stock}/{$item->minimum_stock}");
            }
        }
        
        // Movimientos recientes
        $recentMovements = InventoryMovement::with(['inventoryItem', 'performedBy'])
            ->orderBy('movement_date', 'desc')
            ->limit(5)
            ->get();
        
        $this->line("   📋 Movimientos recientes:");
        foreach ($recentMovements as $movement) {
            $this->line("      • {$movement->inventoryItem->name}: {$movement->getMovementTypeText()} ({$movement->quantity})");
        }
        
        $this->newLine();
    }

    private function showApiRoutes()
    {
        $this->info('🔗 RUTAS API DEL INVENTARIO');
        $this->line('---------------------------');
        
        $routes = [
            'GET /api/inventory' => 'Listar items de inventario',
            'POST /api/inventory' => 'Crear nuevo item',
            'GET /api/inventory/{id}' => 'Obtener item específico',
            'PUT /api/inventory/{id}' => 'Actualizar item',
            'DELETE /api/inventory/{id}' => 'Eliminar item',
            'POST /api/inventory/{id}/update-stock' => 'Actualizar stock',
            'GET /api/inventory-movements' => 'Obtener movimientos',
            'GET /api/inventory/low-stock' => 'Items con stock bajo',
            'GET /api/inventory/stats' => 'Estadísticas del inventario',
            'GET /api/inventory/search' => 'Buscar items',
            'GET /api/inventory/for-repair' => 'Items para reparaciones',
        ];
        
        foreach ($routes as $route => $description) {
            $this->line("   ✅ {$route} - {$description}");
        }
        
        $this->newLine();
    }
}






