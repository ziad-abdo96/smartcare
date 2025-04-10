<?php
namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function index()
    {
        $this->authorize('admin.view');
        $admins = User::where('type', 'admin')->get();

        return view('dashboard.admins.index', compact('admins'));
    }

    public function create()
    {
        $this->authorize('admin.create');
        $admin = new User();
        $roles = Role::all();
        return view('dashboard.admins.create', compact('admin', 'roles'));
    }

    public function store(Request $request)
    {
        $this->authorize('admin.create');
        $request->validate(User::rules());

        $imagePath = User::uploadImage($request);

        $user = User::createAdmin($request, $imagePath);

        $user->assignRole($request->post('role_id'));

        return redirect()->route('dashboard.admins.index')->with('success', 'User stored successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('admin.view');
        $admin = User::findOrFail($id);
        return view('dashboard.admins.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('admin.update');
        $admin = User::findOrFail($id);

        $roles = Role::all();

        return view('dashboard.admins.edit', compact('admin', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('admin.update');
        $admin = User::findOrFail($id);
        $request->validate(User::rules($admin->id), [
            'image' => 'this field is not image',
        ]);

        $imagePath = User::uploadImage($request, $admin);

        $admin->update([
            'name'          => $request->post('name'),
            'email'         => $request->post('email'),
            'password'      => Hash::make($request->post('password')),
            'type'          => 'admin',
            'date_of_birth' => $request->post('date_of_birth'),
            'phone'         => $request->post('phone'),
            'gender'        => $request->post('gender'),
        ]);

        $admin->roles()->sync([$request->post('role_id')]);
        if ($imagePath) {
            $admin->image = $imagePath;
            $admin->save();
        }

        return redirect()->route('dashboard.admins.index')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('admin.delete');
        $admin = User::findOrFail($id);

        if ($admin->image && file_exists(public_path($admin->image))) {
            unlink(public_path($admin->image));
        }

        $deleted = $admin->delete();

        return $deleted
        ? redirect()->route('dashboard.admins.index')->with('success', 'User deleted successfully')
        : redirect()->back()->with('error', 'User not found');
    }
}
