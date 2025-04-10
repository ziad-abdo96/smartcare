<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Models\User;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::with('user')->get();
        return view('front.patient.index', compact('patients'));
    }

    
    public function show($id)
    {
        $patient = Patient::with('user')->findOrFail($id);
        return view('front.patient.show', compact('patient'));
    }

    public function showInfo($id)
    {
        $patient = Patient::with('user')->findOrFail($id);
        return view('front.patient.info', compact('patient'));
    }

 
    public function create()
    {
        $doctors = User::where('type', 'doctor')->get();
        return view('front.patient.create', compact('doctors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female',
            'room_number' => 'nullable|string|max:50',
            //'doctor_id' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => strtolower(str_replace(' ', '_', $request->name)) . '_' . time() . '@patient.com',
            'password' => bcrypt('password123'),
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'role' => 'patient', 
        ]);

        Patient::create([
            'user_id' => $user->id,
            'doctor_id' => $request->doctor_id,
            'room_number' => $request->room_number,
            'entry_date' => now(),
        ]);

        return redirect()->route('patient.index')->with('success', 'Patient added successfully.');
    }


    public function edit($id)
    {
        $patient = Patient::with('user')->findOrFail($id);
        return view('front.patient.edit', compact('patient'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female',
            'room_number' => 'nullable|string|max:50',
        ]);

        $patient = Patient::findOrFail($id);
        $patient->user->update([
            'name' => $request->name,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
        ]);

        $patient->update([
            'room_number' => $request->room_number,
        ]);

        return redirect()->route('patient.index')->with('success', 'Patient updated successfully.');
    }

    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);
        $patient->user->delete();
        $patient->delete(); 

        return redirect()->route('patient.index')->with('success', 'Patient deleted successfully.');
    }
}


