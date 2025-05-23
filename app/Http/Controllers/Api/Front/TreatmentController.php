<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Treatment;
use App\Models\User;
use App\Notifications\TreatmentNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Notification;

class TreatmentController extends Controller
{
    public function index($id)
    {
        $patient = Patient::findOrFail($id);
        $treatments   = $patient->treatments;
        return response()->json([
            'patient' => $patient,
            'treatments' => $treatments
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(Treatment::rules());

        $due_date = Carbon::parse($request->due_date)->format('Y-m-d');

        $due_time = Carbon::parse($request->due_time)->format("H:i");

        $treatment = Treatment::create([
            'name'       => $request->name,
            'description' => $request->description,
            'due_date'    => $due_date,
            'due_time'    => $due_time,
            'patient_id'  => $request->patient_id,
        ]);

        $nurses = User::where('type', 'nurse')->get();

        Notification::send($nurses, new TreatmentNotification($treatment));

       return response()->json([
            'message' => 'Task created successfully!',
            'treatment'    => $treatment,
        ], 201);
    }
   

    public function show($id)
    {
        $patient = Patient::with(['user', 'treatments'])->findOrFail($id);

        return response()->json([
            'patient' => $patient,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:completed,pending',
            'result' => 'string',
            'file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:10240',
        ]);

        $treatment = Treatment::findOrFail($id);

        $treatment->update([
            'status' => $request->status,
            'result' => $request->result,
        ]);
        if ($request->hasFile('file')) {

            $filePath = Treatment::uploadFile($request, $treatment);
    
            $treatment->update([
                'file_path' => $filePath,
            ]);

        }

        return response()->json([
            'message' => 'Treatment updated successfully!',
            'treatment' => $treatment,
        ], 200);
    }


 
    public function destroy($id)
    {
        $treatment = Treatment::findOrFail($id);
        $treatment->delete();

        return response()->json([
            'message' => 'Treatment deleted successfully',
        ], 200);
    }
}
