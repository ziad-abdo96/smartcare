<?php
namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('role.view');
        $roles = Role::all();
        return view('dashboard.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('role.create');
        $role = new Role();
        return view('dashboard.roles.create', compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('role.create');
        $request->validate(Role::rules());

        $role = Role::createWithAbilities($request);

        return redirect()
            ->route('dashboard.roles.index')
            ->with('success', 'Role created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('role.view');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id  
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $this->authorize('role.update');
        $role_abilities = $role->abilities()->pluck('type', 'ability')->toArray();
        return view('dashboard.roles.edit', compact('role', 'role_abilities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $this->authorize('role.update');
        $request->validate(Role::rules());

        $role->updateWithAbilities($request);

        return redirect()
            ->route('dashboard.roles.index')
            ->with('success', 'Role Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $this->authorize('role.delete');
        $role->delete();
        
        return redirect()
            ->route('dashboard.roles.index')
            ->with('success', 'Role deleted successfully');
    }
}
