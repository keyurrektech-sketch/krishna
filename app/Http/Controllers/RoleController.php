<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    function __construct()
    {
        // Removed middleware that was causing 403 errors
        // Permissions are now checked individually in each method
    }

    public function index(Request $request): View
    {
        // Check if user has permission to view roles
        if (!Auth::user()->can('view-employees')) {
            abort(403, 'Unauthorized access');
        }

        $roles = Role::orderBy('id', 'DESC')->paginate(5);
        return view('roles.index', compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create(): View
    {
        // Check if user has permission to create roles
        if (!Auth::user()->can('add-employee')) {
            abort(403, 'Unauthorized access');
        }

        $permission = Permission::get();
        return view('roles.create', compact('permission'));
    }

    public function store(Request $request)
    {
        // Check if user has permission to store roles
        if (!Auth::user()->can('add-employee')) {
            abort(403, 'Unauthorized access');
        }

        $this->validate($request, [
            'name' => 'required|unique:roles,name',
        ]);

        $role = Role::create(['name' => $request->input('name')]);

        if ($request->has('permission')) {
            $permissionsID = array_map('intval', $request->input('permission'));
            $role->syncPermissions($permissionsID);
        }

        if ($request->expectsJson()) {
            return response()->json([
                'id' => $role->id,
                'name' => $role->name,
                'message' => 'Role added successfully'
            ]);
        }

        return redirect()->route('roles.index')
            ->with('success', 'Role created successfully.');
    }


    public function show($id): View
    {
        // Check if user has permission to view roles
        if (!Auth::user()->can('view-employees')) {
            abort(403, 'Unauthorized access');
        }

        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();

        return view('roles.show', compact('role', 'rolePermissions'));
    }

    public function edit($id): View
    {
        // Check if user has permission to edit roles
        if (!Auth::user()->can('edit-employees')) {
            abort(403, 'Unauthorized access');
        }

        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('roles.edit', compact('role', 'permission', 'rolePermissions'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        // Check if user has permission to update roles
        if (!Auth::user()->can('edit-employees')) {
            abort(403, 'Unauthorized access');
        }

        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $permissionsID = array_map(function ($value) {
            return (int)$value;
        }, $request->input('permission'));

        $role->syncPermissions($permissionsID);

        return redirect()->route('roles.index')
            ->with('success', 'Role updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        // Check if user has permission to delete roles
        if (!Auth::user()->can('edit-employees')) {
            abort(403, 'Unauthorized access');
        }

        DB::table("roles")->where('id', $id)->delete();
        return redirect()->route('roles.index')
            ->with('success', 'Role deleted successfully');
    }
}