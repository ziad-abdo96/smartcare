<?php
namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    
    public function index()
    {
        $this->authorize('department.view');
        $departments = Department::all();
        return view('dashboard.departments.index', compact('departments'));
    }

    public function create()
    {
        $department = new Department();
        return view('dashboard.departments.create', compact('department'));
    }


    public function store(Request $request)
    {
        $this->authorize('department.create');
        $request->validate(Department::rules());

        Department::create([
            'name'        => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('dashboard.departments.index')->with('success', 'departments created successfully!');
    }


    public function show($id)
    {
        $this->authorize('department.view');
    }

    
    public function edit($id)
    {
        $this->authorize('department.update');
        $department = Department::findOrFail($id);
        return view('dashboard.departments.edit', compact('department'));
    }

 
    public function update(Request $request, $id)
    {
        $this->authorize('department.update');
        $department = Department::findOrFail($id);
        $request->validate(Department::rules($id));

        $department->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('dashboard.departments.index')->with('success', 'the department updated successfully!');
    }

    public function destroy($id)
    {
        $this->authorize('department.delete');
        $department = Department::findOrFail($id);
        $deleted = $department->delete();
        

        return $deleted 
        ? redirect()->back()->with('success', 'the department deleted successfully!')
        : redirect()->back()->with('error', 'department not found');
    }
}
