<?php

namespace Modules\Role\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Role\Http\Requests\StoreRoleRequest;
use Modules\Role\Http\Requests\UpdateRoleRequest;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:roles-create')->only('create', 'store');
        $this->middleware('permission:roles-read')->only('index', 'show');
        $this->middleware('permission:roles-update')->only('edit', 'update');
        $this->middleware('permission:roles-delete')->only('destroy');
    }

    public function index()
    {
        $roles = Role::with('users')->withCount('users')->get();
        return view('role::index', [
            'roles' => $roles
        ]);
    }

    public function create()
    {
        $groups = [];
        foreach (Permission::all() as $index => $permission) {
            $groups[ucwords(str($permission->name)->remove(['-', 'create','read','update','delete']))][] = $permission;
        }

        return view('role::create', [
            'groups' => $groups
        ]);
    }

    public function store(StoreRoleRequest $request)
    {
        \DB::transaction(function ()use ($request){
            $role = Role::create([
                'name' => $request->input('name')
            ]);

            $role->permissions()->sync($request->input('permissions'));
        });

        return response()->json([
            'message' => __('Role Created Successfully'),
            'redirect' => route('admin.roles.index')
        ]);
    }

    public function show($id)
    {
        return view('role::show');
    }

    public function edit(Role $role)
    {
        $role->load('permissions');
        $groups = [];
        foreach (Permission::all() as $index => $permission) {
            $groups[ucwords(str($permission->name)->remove(['-', 'create','read','update','delete']))][] = $permission;
        }

        return view('role::edit', compact('role', 'groups'));
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update([
            'name' => $request->input('name')
        ]);

        $role->permissions()->sync($request->input('permissions'));

        return response()->json([
            'message' => __('Role Update Successfully'),
            'redirect' => route('admin.roles.index')
        ]);
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return response()->json([
            'message' => __('Role Deleted Successfully'),
            'redirect' => route('admin.roles.index')
        ]);
    }
}
