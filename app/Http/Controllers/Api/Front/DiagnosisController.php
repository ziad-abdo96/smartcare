<?php
namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Models\Diagnosis;
use App\Models\Patient;
use Illuminate\Http\Request;

class DiagnosisController extends Controller
{
    public function index($patientId)
    {
        $patient = Patient::findOrFail($patientId);
        $diagnoses = $patient->diagnoses()->latest()->get();

        return response()->json([
            'status' => 'success',
            'patient' => $patient->only(['id', 'name', 'room_number']),
            'diagnoses' => $diagnoses
        ]);
    }

    public function store(Request $request, $patientId)
    {
        $request->validate([
            'diagnosis' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $diagnosis = Diagnosis::create([
            'patient_id' => $patientId,
            'doctor_id' => auth()->id(),
            'diagnosis' => $request->diagnosis,
            'notes' => $request->notes,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Diagnosis added successfully.',
            'data' => $diagnosis
        ], 201);
    }
}
