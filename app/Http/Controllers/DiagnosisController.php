<?php

namespace App\Http\Controllers;

use App\Models\Diagnosis;
use App\Models\Patient;
use Illuminate\Http\Request;

class DiagnosisController extends Controller
{
    public function index($patientId)
    {
        $patient = Patient::findOrFail($patientId);
        $diagnoses = $patient->diagnoses()->latest()->get();
        return view('front.patient.diagnoses.index', compact('patient', 'diagnoses'));
    }

    public function store(Request $request, $patientId)
    {
        $request->validate([
            'diagnosis' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        Diagnosis::create([
            'patient_id' => $patientId,
            'doctor_id' => auth()->id(),
            'diagnosis' => $request->diagnosis,
            'notes' => $request->notes,
        ]);

        return redirect()->back()->with('success', 'Diagnosis added successfully.');
    }
}
