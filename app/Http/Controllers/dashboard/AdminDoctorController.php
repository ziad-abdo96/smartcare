<?php
namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminDoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('doctor.view');
        $doctors = Doctor::withUser()->get();

        return view('dashboard.doctors.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('doctor.create');
        $doctor      = new Doctor();
        $departments = Department::get();
        return view('dashboard.doctors.create', compact('doctor', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('doctor.create');
        $request->validate(Doctor::rules());

        $imagePath = Doctor::uploadImage($request);

        $user = User::createWithDoctor($request, $imagePath);

        return redirect()->route('dashboard.doctors.index')->with('success', 'Doctor stored successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('doctor.view');
        $doctor = Doctor::with('user')->findOrFail($id);
        return view('dashboard.doctors.show', compact('doctor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('doctor.update');
        $doctor      = Doctor::findWithUser($id);
        $departments = Department::all();
        return view('dashboard.doctors.edit', compact('doctor', 'departments'));
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
        $this->authorize('doctor.update');
        $doctor = Doctor::findWithUser($id);
        $request->validate(Doctor::rules($doctor->user->id), [
            'image' => 'this field is not image',
        ]);

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

        return redirect()->route('dashboard.doctors.index')->with('success', 'Doctor updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('doctor.delete');
        $doctor = Doctor::findOrFail($id);

        if ($doctor->user->image && file_exists(public_path($doctor->user->image))) {
            unlink(public_path($doctor->user->image));
        }

        $deleted = $doctor->delete();
        
        return $deleted
        ? redirect()->route('dashboard.doctors.index')->with('success', 'Doctor deleted successfully')
        : redirect()->back()->with('error', 'Doctor not found');
    }
}
