<?php
namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Models\Diagnosis;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiagnosisController extends Controller
{
    public function index($patientId)
    {
        $patient = Patient::findOrFail($patientId);
       // $diagnoses = $patient->diagnoses()->orderBy('id', 'desc')->first();
       $diagnoses = Diagnosis::where('patient_id', $patientId)
            ->orderBy('id', 'desc')
            ->first();
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
            'diagnosis' => $diagnosis
        ], 201);
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'diagnosis' => 'required|string',
        'notes' => 'nullable|string',
    ]);

    $diagnosis = Diagnosis::where('doctor_id', Auth::user()->id)->findOrFail($id);

    $diagnosis->update([
        'diagnosis' => $request->diagnosis,
        'notes' => $request->notes,
    ]);

    return response()->json([
        'status' => 'success',
        'message' => 'Diagnosis updated successfully.',
        'data' => $diagnosis
    ]);
}

}
