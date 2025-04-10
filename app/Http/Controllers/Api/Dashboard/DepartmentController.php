<?php
namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{

    public function index()
    {
        $this->authorize('department.view');
        $departments = Department::all();
        return response()->json($departments ?? 'there no department');
    }

    public function show($id)
    {
        $this->authorize('department.view');
        $department = Department::find($id);

        if (!$department) {
            return response()->json(['message' => 'Department not found'], 404);
        }

        return response()->json($department);
    }

    public function store(Request $request)
    {
        $this->authorize('department.create');
        $request->validate(Department::rules());

        $department = Department::create([
            'name'        => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return response()->json($department, 201); 
    }

   
    public function update(Request $request, $id)
    {
        $this->authorize('department.update');
        $department = Department::find($id);

        if (!$department) {
            return response()->json(['message' => 'Department not found'], 404);
        }

        $request->validate(Department::rules($id));

        $department->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return response()->json($department);
    }


    public function destroy($id)
    {
        $this->authorize('department.delete');
        $department = Department::find($id);

        if (!$department) {
            return response()->json(['message' => 'Department not found'], 404);
        }

        $department->delete();
        return response()->json(['message' => 'Department deleted successfully']);
    }
}
