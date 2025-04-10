<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    
    public function index()
    {
        $this->authorize('role.view');
        $roles = Role::all();
        return response()->json([
            'roles' => $roles,
        ], 200);
    }


    public function store(Request $request)
    {
        $this->authorize('role.update');
        $request->validate(Role::rules());

        $role = Role::createWithAbilities($request);

        return response()->json([
            'message' => 'Role Created successfully',
            'role' => $role,
        ], 201);
    }

    public function show($id)
    {
        $this->authorize('role.view');
        
        $role = Role::findOrFail($id);

        return response()->json([
            'doctor' => $role,
        ], 200);

    }


    public function update(Request $request, Role $role)
    {
        $this->authorize('role.update');
        $request->validate(Role::rules());

        $role->updateWithAbilities($request);

        return response()->json([
            'message' => 'Role Update successfully!',
        ]);
    }


    public function destroy($id)
    {
        $this->authorize('role.delete');
        Role::destroy($id);
    
        return response()->json([
            'message' => 'Role deleted successfully',
        ]);
    }
}
