<?php
namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminDoctorController extends Controller
{

    public function index()
    {
        
        $doctors = Doctor::withUser()->get();

        return response()->json([
            'doctors' => $doctors ?? 'there no doctors',
        ], 200);
    }

    public function store(Request $request)
    {
        $this->authorize('doctor.create');
        $request->validate(Doctor::rules());

        $imagePath = Doctor::uploadImage($request);

        $user = User::create([
            'name'          => $request->post('name'),
            'email'         => $request->post('email'),
            'password'      => Hash::make($request->post('password')),
            'type'          => 'doctor',
            'date_of_birth' => $request->post('date_of_birth'),
            'phone'         => $request->post('phone'),
            'gender'        => $request->post('gender'),
            'image'         => $imagePath,
        ]);

        $doctor = Doctor::create([
            'user_id'       => $user->id,
            'department_id' => $request->input('department_id'),
            'about'         => $request->post('about'),
            'specialty'     => $request->post('specialty'),
        ]);

        return response()->json([
            'doctor' => $doctor,
        ], 200);
    }

    public function show($id)
    {
        $this->authorize('doctor.view');
        $doctor = Doctor::with('user')->findOrFail($id);
        return response()->json([
            'doctor' => $doctor,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('doctor.update');
        $doctor = Doctor::with('user')->findOrFail($id);

        $request->validate(Doctor::rules($doctor->user->id));

        $imagePath = Doctor::uploadImage($request, $doctor);

        $doctor->user->update([
            'name'          => $request->post('name'),
            'email'         => $request->post('email'),
            'password'      => Hash::make($request->post('password')),
            'type'          => 'doctor',
            'date_of_birth' => $request->post('date_of_birth'),
            'phone'         => $request->post('phone'),
            'gender'        => $request->post('gender'),
        ]);

        if ($imagePath) {
            $doctor->user->image = $imagePath;
            $doctor->user->save();
        }

        $doctor->update([
            'about'         => $request->post('about'),
            'specialty'     => $request->post('specialty'),
            'department_id' => $request->post('department_id'),
        ]);

        return response()->json([
            'message' => 'Doctor updated successfully',
            'data' => $doctor,
        ], 200);
    }

    public function destroy($id)
    {
        $this->authorize('doctor.delete');
        $doctor = Doctor::findOrFail($id);

        if ($doctor->user->image && file_exists(public_path($doctor->user->image))) {
            unlink(public_path($doctor->user->image));
        }

        $doctor->delete();

        return response()->json([
            'message' => 'Doctor deleted successfully',
        ], 200);
    }
}
