<?php
namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminPatientController extends Controller
{
    
    public function index()
    {
        $this->authorize('patient.view');
        $patients = Patient::withUser()->get();    
        return view('dashboard.patients.index', compact('patients'));
    }

    
    public function create()
    {
        $patient = new Patient();
        $this->authorize('patient.create'); 
        $doctors = Doctor::all();
        return view('dashboard.patients.create', compact('patient', 'doctors'));
    }


    public function store(Request $request)
    {
        $this->authorize('patient.create');
        
        $request->validate(Patient::rules());

        $imagePath = Patient::uploadImage($request);
        $entryDate = Carbon::parse($request->entry_date)->format('Y-m-d');

        $user = User::createWithPatient($request, $imagePath, $entryDate);

        return redirect()->route('dashboard.patients.index')->with('success', 'The patient stored successfully');
    }


    public function show($id)
    {
        $this->authorize('patient.view');
        $patient = Patient::findWithUser($id);
        return view('dashboard.patients.show', compact('patient'));
    }

 

    public function edit($id)
    {
        $this->authorize('patient.update');
        $patient = Patient::findWithUser($id);
        $doctors = Doctor::all();
        return view('dashboard.patients.edit', compact('patient', 'doctors'));
    }

  

    public function update(Request $request, $id)
    {
        $this->authorize('patient.update');

        $patient = Patient::findWithUser($id);
        $request->validate(Patient::rules($patient->id, $patient->user->id), [
            'image' => 'this field is not image',
        ]);


        $imagePath = Doctor::uploadImage($request, $patient);
        $entryDate = Carbon::parse($request->entry_date)->format('Y-m-d');

        $patient->user->update([
            'name'          => $request->post('name'),
            'email'         => $request->post('email'),
            'password'      => Hash::make($request->post('password')),
            'type'          => 'patient',
            'date_of_birth' => $request->post('date_of_birth'),
            'phone'         => $request->post('phone'),
            'gender'        => $request->post('gender'),
        ]);

        if ($imagePath) {
            $patient->user->image = $imagePath;
            $patient->user->save();
        }
        $patient->update([
            'doctor_id'                => $request->post('doctor_id'),
            'city'                     => $request->post('city'),
            'street'                   => $request->post('street'),
            'entry_date'               => $entryDate,
            'blood_type'               => $request->post('blood_type'),
            'national_id'              => $request->post('national_id'),
            'description_of_condition' => $request->post('description_of_condition'),
            'room_number'              => $request->post('room_number'),
        ]);


        return redirect()->route('dashboard.patients.index')->with('success', 'The patient updated successfully');
    }
    
    
    public function destroy($id)
    {
        $this->authorize('patient.delete');
        $patient = Patient::findOrFail($id);

        if ($patient->user->image && file_exists(public_path($patient->user->image))) {
            unlink(public_path($patient->user->image));
        }

        $deleted = $patient->delete();

        return $deleted
        ? redirect()->route('dashboard.patients.index')->with('success', 'patient deleted successfully')
        : redirect()->back()->with('error', 'The Patient not found');

    }
}
