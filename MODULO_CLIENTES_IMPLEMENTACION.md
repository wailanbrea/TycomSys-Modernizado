# 📋 Módulo de Clientes - Implementación Completa

## ✅ Completado

### 1. **Backend (Laravel)**

#### **Modelo Customer** (`app/Models/Customer.php`)
- ✅ Campos: `customer_code`, `customer_type`, `first_name`, `last_name`, `company_name`, `tax_id`, `email`, `phone`, `mobile`, `address`, `city`, `state`, `postal_code`, `country`, `website`, `notes`, `status`, `payment_terms`, `credit_limit`
- ✅ Relaciones:
  - `hasMany` → `invoices`
  - `hasMany` → `repairEquipments`
  - `hasManyThrough` → `tickets`
- ✅ Métodos helper: `getFullNameAttribute()`, `getDisplayNameAttribute()`, `getTotalInvoicedAttribute()`, `getTotalPaidAttribute()`, `getTotalPendingAttribute()`, `getHistory()`
- ✅ Scopes: `active()`, `byType()`, `search()`

#### **Migraciones**
- ✅ `2025_10_07_020000_create_customers_table.php` - Tabla customers
- ✅ `2025_10_07_020001_add_customer_id_to_invoices_and_repair_equipment.php` - Agregar customer_id a invoices y repair_equipment

#### **Modelos Actualizados**
- ✅ `Invoice.php` - Agregado campo `customer_id` y relación `belongsTo(Customer::class)`
- ✅ `RepairEquipment.php` - Agregado campo `customer_id` y relación `belongsTo(Customer::class)`

#### **Seeder**
- ✅ `CustomerSeeder.php` - 10 clientes de ejemplo (individuos y empresas)
- ✅ `DatabaseSeeder.php` actualizado para incluir CustomerSeeder

#### **Controller**
- ✅ `CustomerController.php` con endpoints completos:
  - `index()` - Listar clientes (con búsqueda, filtros, paginación)
  - `store()` - Crear cliente
  - `show($id)` - Ver cliente
  - `update($id)` - Actualizar cliente
  - `destroy($id)` - Eliminar cliente
  - `history($id)` - Historial completo del cliente
  - `statistics($id)` - Estadísticas del cliente
  - `toggleStatus($id)` - Activar/desactivar cliente
  - `getActiveCustomers()` - Clientes activos para dropdowns
  - `search()` - Búsqueda para autocomplete

#### **Rutas** (`routes/web.php`)
- ✅ API endpoints agregados:
  ```php
  Route::apiResource('customers', CustomerController::class);
  Route::get('/customers/{id}/history', [CustomerController::class, 'history']);
  Route::get('/customers/{id}/statistics', [CustomerController::class, 'statistics']);
  Route::post('/customers/{id}/toggle-status', [CustomerController::class, 'toggleStatus']);
  Route::get('/customers-active', [CustomerController::class, 'getActiveCustomers']);
  Route::get('/customers-search', [CustomerController::class, 'search']);
  ```
- ✅ Rutas web para vistas React:
  - `/admin/customers` - Gestión de clientes (Admin)
  - `/admin/customer-history/{id}` - Historial de cliente (Admin)
  - `/tecnico/customers` - Gestión de clientes (Técnico)
  - `/tecnico/customer-history/{id}` - Historial de cliente (Técnico)

---

## 🔄 Pendiente - Frontend React

### 2. **Componentes React a Crear**

#### **A. `frontend/src/views/examples/CustomerManagement.js`**
**Funcionalidad:**
- Tabla de clientes con paginación
- Búsqueda por: código, nombre, empresa, email, teléfono, RNC
- Filtros: tipo de cliente (individual/empresa), estado (activo/inactivo)
- Botones de acción: Ver, Editar, Eliminar, Ver Historial
- Modal para crear/editar cliente con validación
- Toggle status (activar/desactivar)

**Campos del formulario:**
- Tipo de cliente (radio buttons: Individual / Empresa)
- **Si Individual:** Nombre, Apellido
- **Si Empresa:** Nombre de Empresa, Persona de Contacto (Nombre + Apellido)
- RNC/Cédula
- Email, Teléfono, Celular
- Dirección, Ciudad, Provincia, Código Postal
- Sitio Web (opcional)
- Notas (textarea)
- Estado (switch: Activo/Inactivo)
- Términos de Pago (días)
- Límite de Crédito

**Estadísticas a mostrar:**
- Total de clientes
- Clientes activos
- Clientes inactivos
- Total facturado
- Total pendiente de pago

#### **B. `frontend/src/views/examples/CustomerHistory.js`**
**Funcionalidad:**
- Información del cliente en card superior
- Estadísticas del cliente:
  - Total facturado
  - Total pagado
  - Saldo pendiente
  - Total de reparaciones
  - Total de tickets
- Tabs (pestañas):
  1. **Facturas** - Lista de facturas con estado, monto, fecha
  2. **Reparaciones** - Equipos en reparación con estado, técnico asignado
  3. **Tickets** - Tickets asociados con prioridad y estado
  4. **Cronología** - Timeline de todas las acciones (facturas, reparaciones, pagos)

**Gráficos:**
- Gráfico de barras: Facturas por mes
- Gráfico de pastel: Estado de reparaciones

#### **C. Actualizar `RepairEquipmentManagement.js`**
Agregar:
- Selector de cliente (autocomplete)
- Campo opcional para ingresar datos manualmente si el cliente no existe
- Al seleccionar cliente, auto-completar: nombre, teléfono, email

#### **D. Actualizar `InvoiceManagement.js`**
Agregar:
- Selector de cliente (autocomplete)
- Mostrar información del cliente al seleccionarlo
- Vincular factura al cliente seleccionado

#### **E. Actualizar `Sidebar.js` y menús**
Agregar en Admin y Técnico:
```jsx
{
  path: "/admin/customers",
  name: "Clientes",
  icon: "ni ni-single-02 text-blue",
  component: CustomerManagement,
  layout: "/admin",
}
```

---

## 🚀 Comandos de Migración

Para aplicar los cambios en la base de datos:

```bash
# En desarrollo (local)
php artisan migrate

# En producción (Render)
php artisan migrate --force
php artisan db:seed --class=CustomerSeeder --force
```

---

## 📊 Flujo de Trabajo

### **Escenario 1: Crear Nueva Reparación**
1. Técnico crea nueva reparación
2. Busca cliente existente (autocomplete)
3. Si existe: se auto-completan datos
4. Si no existe: ingresa datos manualmente → se crea cliente automático
5. Se guarda reparación vinculada al cliente

### **Escenario 2: Ver Historial de Cliente**
1. Admin/Técnico busca cliente
2. Click en "Ver Historial"
3. Se muestra:
   - Todas las facturas
   - Todas las reparaciones
   - Todos los tickets
   - Estadísticas de pagos

### **Escenario 3: Generar Factura**
1. Admin crea factura desde reparación
2. Se auto-selecciona el cliente de la reparación
3. Se genera factura vinculada al cliente

---

## 🔗 Relaciones entre Módulos

```
Customer (Cliente)
├── hasMany → Invoice (Facturas)
│   └── hasMany → InvoiceItem (Items de Factura)
├── hasMany → RepairEquipment (Reparaciones)
│   ├── belongsTo → EquipmentBrand
│   ├── belongsTo → EquipmentType
│   ├── belongsTo → EquipmentModel
│   └── hasMany → Ticket
└── hasManyThrough → Ticket (via RepairEquipment)
```

---

## ✨ Beneficios del Módulo

1. **Centralización:** Toda la información del cliente en un solo lugar
2. **Trazabilidad:** Historial completo de interacciones
3. **Eficiencia:** Auto-completado de datos en nuevas reparaciones/facturas
4. **Reportes:** Análisis de clientes más rentables, frecuentes, etc.
5. **CRM Básico:** Notas, términos de pago, límites de crédito

---

## 🎯 Próximos Pasos

1. ✅ **Backend completado** (Modelos, Controladores, Rutas, Seeders)
2. ⏳ **Frontend pendiente:**
   - Crear `CustomerManagement.js`
   - Crear `CustomerHistory.js`
   - Actualizar `RepairEquipmentManagement.js` para incluir selector de cliente
   - Actualizar `InvoiceManagement.js` para incluir selector de cliente
   - Actualizar menús y rutas en React
3. ⏳ **Testing:**
   - Probar CRUD de clientes
   - Probar historial
   - Probar vinculación con reparaciones y facturas

---

## 📝 Notas Importantes

- Los campos `customer_name`, `customer_phone`, `customer_email` en `invoices` y `repair_equipment` se mantienen para **compatibilidad** con datos existentes
- El campo `customer_id` es **nullable** para no romper registros antiguos
- Al crear nuevas reparaciones/facturas, se debe priorizar el uso de `customer_id`
- Los clientes pueden ser **individuos** (`individual`) o **empresas** (`company`)
- Los clientes tienen un código único autogenerado (`CLI-2025-0001`, `CLI-2025-0002`, etc.)

---

**Desarrollado por:** TicomSys Development Team  
**Fecha:** 7 de Octubre, 2025  
**Versión:** 1.0

