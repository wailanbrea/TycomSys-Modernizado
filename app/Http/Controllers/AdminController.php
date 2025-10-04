<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function dashboard()
    {
        $users = User::with('roles')->get();
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();
        
        return view('admin.dashboard', compact('users', 'roles', 'permissions'));
    }

    public function users()
    {
        $users = User::with('roles')->get();
        return view('admin.users', compact('users'));
    }

    public function roles()
    {
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();
        return view('admin.roles', compact('roles', 'permissions'));
    }

    public function assignRole(Request $request, User $user)
    {
        $role = Role::findOrFail($request->role_id);
        $user->assignRole($role);
        
        return redirect()->back()->with('success', 'Rol asignado correctamente');
    }

    public function removeRole(User $user, Role $role)
    {
        $user->removeRole($role);
        
        return redirect()->back()->with('success', 'Rol removido correctamente');
    }

    // API Methods
    public function getUsers()
    {
        $users = User::with('roles')->get();
        return response()->json($users);
    }

    public function getRoles()
    {
        $roles = Role::with('permissions')
            ->withCount('users')
            ->get();
        return response()->json($roles);
    }

    public function getPermissions()
    {
        $permissions = Permission::withCount('roles')->get();
        return response()->json($permissions);
    }

    public function storeRole(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'display_name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $role = Role::create([
            'name' => $request->name,
            'display_name' => $request->display_name,
            'description' => $request->description
        ]);

        return response()->json([
            'message' => 'Rol creado exitosamente',
            'role' => $role
        ], 201);
    }

    public function updateRole(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $id,
            'display_name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $role->update([
            'name' => $request->name,
            'display_name' => $request->display_name,
            'description' => $request->description
        ]);

        return response()->json([
            'message' => 'Rol actualizado exitosamente',
            'role' => $role
        ]);
    }

    public function destroyRole($id)
    {
        $role = Role::findOrFail($id);
        
        // Verificar si el rol tiene usuarios asignados
        if ($role->users()->count() > 0) {
            return response()->json([
                'message' => 'No se puede eliminar el rol porque tiene usuarios asignados'
            ], 422);
        }

        $role->delete();

        return response()->json([
            'message' => 'Rol eliminado exitosamente'
        ]);
    }
}
