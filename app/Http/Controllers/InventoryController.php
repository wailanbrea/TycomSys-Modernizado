<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\InventoryItem;
use App\Models\InventoryMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Obtener todos los items de inventario
     */
    public function index(Request $request)
    {
        $query = InventoryItem::query();

        // Filtros
        if ($request->has('search') && $request->search) {
            $query->search($request->search);
        }

        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }

        if ($request->has('status') && $request->status) {
            switch ($request->status) {
                case 'low_stock':
                    $query->lowStock();
                    break;
                case 'out_of_stock':
                    $query->where('current_stock', 0);
                    break;
                case 'in_stock':
                    $query->where('current_stock', '>', 0)
                          ->whereRaw('current_stock > minimum_stock');
                    break;
            }
        }

        if ($request->has('active_only') && $request->active_only) {
            $query->active();
        }

        $items = $query->with('movements')
            ->orderBy('name')
            ->paginate(15);

        return response()->json($items);
    }

    /**
     * Crear un nuevo item de inventario
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|in:part,component,accessory,tool,consumable',
            'brand' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'compatible_equipment' => 'nullable|string|max:255',
            'current_stock' => 'required|integer|min:0',
            'minimum_stock' => 'required|integer|min:0',
            'maximum_stock' => 'required|integer|min:0',
            'unit' => 'required|string|max:10',
            'cost_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'supplier_name' => 'nullable|string|max:255',
            'supplier_contact' => 'nullable|string|max:255',
            'supplier_phone' => 'nullable|string|max:20',
            'supplier_email' => 'nullable|email|max:255',
            'location_aisle' => 'nullable|string|max:50',
            'location_shelf' => 'nullable|string|max:50',
            'location_position' => 'nullable|string|max:50',
            'notes' => 'nullable|string',
            'barcode' => 'nullable|string|max:255|unique:inventory_items',
        ]);

        $item = InventoryItem::create($request->all());

        // Si hay stock inicial, crear movimiento de entrada
        if ($item->current_stock > 0) {
            $item->updateStock(
                $item->current_stock,
                'in',
                'Stock inicial',
                'initial_stock',
                $item->id
            );
        }

        return response()->json([
            'message' => 'Item de inventario creado exitosamente',
            'item' => $item->load('movements')
        ], 201);
    }

    /**
     * Obtener un item específico
     */
    public function show($id)
    {
        $item = InventoryItem::with(['movements.performedBy'])
            ->findOrFail($id);

        return response()->json($item);
    }

    /**
     * Actualizar un item de inventario
     */
    public function update(Request $request, $id)
    {
        $item = InventoryItem::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|in:part,component,accessory,tool,consumable',
            'brand' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'compatible_equipment' => 'nullable|string|max:255',
            'minimum_stock' => 'required|integer|min:0',
            'maximum_stock' => 'required|integer|min:0',
            'unit' => 'required|string|max:10',
            'cost_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'supplier_name' => 'nullable|string|max:255',
            'supplier_contact' => 'nullable|string|max:255',
            'supplier_phone' => 'nullable|string|max:20',
            'supplier_email' => 'nullable|email|max:255',
            'location_aisle' => 'nullable|string|max:50',
            'location_shelf' => 'nullable|string|max:50',
            'location_position' => 'nullable|string|max:50',
            'is_active' => 'boolean',
            'notes' => 'nullable|string',
            'barcode' => 'nullable|string|max:255|unique:inventory_items,barcode,' . $id,
        ]);

        $item->update($request->all());

        return response()->json([
            'message' => 'Item de inventario actualizado exitosamente',
            'item' => $item
        ]);
    }

    /**
     * Eliminar un item de inventario
     */
    public function destroy($id)
    {
        $item = InventoryItem::findOrFail($id);

        // Verificar si tiene movimientos
        if ($item->movements()->count() > 0) {
            return response()->json([
                'message' => 'No se puede eliminar un item que tiene movimientos de inventario'
            ], 422);
        }

        $item->delete();

        return response()->json([
            'message' => 'Item de inventario eliminado exitosamente'
        ]);
    }

    /**
     * Actualizar stock de un item
     */
    public function updateStock(Request $request, $id)
    {
        $item = InventoryItem::findOrFail($id);

        $request->validate([
            'movement_type' => 'required|in:in,out,adjustment',
            'quantity' => 'required|integer|min:1',
            'reason' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'unit_cost' => 'nullable|numeric|min:0',
            'reference_type' => 'nullable|string|max:50',
            'reference_id' => 'nullable|integer',
        ]);

        // Verificar que no se saque más stock del disponible (excepto en ajustes)
        if ($request->movement_type === 'out' && $item->current_stock < $request->quantity) {
            return response()->json([
                'message' => 'No hay suficiente stock disponible'
            ], 422);
        }

        $movement = $item->updateStock(
            $request->quantity,
            $request->movement_type,
            $request->reason,
            $request->reference_type,
            $request->reference_id
        );

        // Actualizar costo si se proporciona
        if ($request->unit_cost) {
            $movement->update([
                'unit_cost' => $request->unit_cost,
                'total_cost' => $request->unit_cost * $request->quantity
            ]);
        }

        return response()->json([
            'message' => 'Stock actualizado exitosamente',
            'movement' => $movement->load('performedBy'),
            'item' => $item->fresh()
        ]);
    }

    /**
     * Obtener movimientos de inventario
     */
    public function getMovements(Request $request)
    {
        $query = InventoryMovement::with(['inventoryItem', 'performedBy']);

        // Filtros
        if ($request->has('item_id') && $request->item_id) {
            $query->where('inventory_item_id', $request->item_id);
        }

        if ($request->has('movement_type') && $request->movement_type) {
            $query->where('movement_type', $request->movement_type);
        }

        if ($request->has('date_from') && $request->date_from) {
            $query->where('movement_date', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to) {
            $query->where('movement_date', '<=', $request->date_to);
        }

        $movements = $query->orderBy('movement_date', 'desc')
            ->paginate(20);

        return response()->json($movements);
    }

    /**
     * Obtener items con stock bajo
     */
    public function getLowStockItems()
    {
        $items = InventoryItem::lowStock()
            ->active()
            ->orderBy('current_stock')
            ->get();

        return response()->json($items);
    }

    /**
     * Obtener estadísticas del inventario
     */
    public function getStats()
    {
        $stats = [
            'total_items' => InventoryItem::count(),
            'active_items' => InventoryItem::active()->count(),
            'low_stock_items' => InventoryItem::lowStock()->active()->count(),
            'out_of_stock_items' => InventoryItem::where('current_stock', 0)->active()->count(),
            'total_stock_value' => InventoryItem::active()
                ->selectRaw('SUM(current_stock * cost_price) as total')
                ->value('total') ?? 0,
            'categories' => InventoryItem::active()
                ->select('category', DB::raw('COUNT(*) as count'))
                ->groupBy('category')
                ->get(),
        ];

        return response()->json($stats);
    }

    /**
     * Buscar items por SKU o nombre
     */
    public function search(Request $request)
    {
        $search = $request->get('q', '');
        
        if (strlen($search) < 2) {
            return response()->json([]);
        }

        $items = InventoryItem::search($search)
            ->active()
            ->select('id', 'sku', 'name', 'current_stock', 'unit', 'selling_price')
            ->limit(10)
            ->get();

        return response()->json($items);
    }

    /**
     * Obtener items para usar en reparaciones
     */
    public function getItemsForRepair()
    {
        $items = InventoryItem::active()
            ->where('current_stock', '>', 0)
            ->select('id', 'sku', 'name', 'current_stock', 'unit', 'selling_price', 'category')
            ->orderBy('name')
            ->get();

        return response()->json($items);
    }
}