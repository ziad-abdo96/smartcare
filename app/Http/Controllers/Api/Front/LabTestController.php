<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Models\LabTest;
use App\Models\Patient;
use App\Models\User;
use App\Notifications\LabTestNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class LabTestController extends Controller
{

    public function show($id)
    {
        $patient  = Patient::with(['user', 'labTests'])->findOrFail($id);

        return response()->json([
            'patient' => $patient,
        ], 200);
    }

    
    public function store(Request $request)
    {
        $request->validate(LabTest::rules());


        $testDate = Carbon::parse($request->test_date)->format('Y-m-d');
        $testTime = Carbon::parse($request->due_time)->format('H:i');
        
        $labTest = LabTest::create([
            'patient_id' => $request->patient_id,
            'name'  => $request->name,
            'due_date'  => $testDate,
            'due_time'  => $testTime,
            'status' => 'pending',
        ]);

        $nurses = User::where('type', 'nurse')->get();
        
        Notification::send($nurses, new LabTestNotification($labTest));

        return response()->json([
            'message' => 'the lab test created successfully!',
            'labTest' => $labTest,
        ], 200);

    }
    public function update(Request $request, $id)
    {
        
        $request->validate([
            'status' => 'required|in:completed,pending',
            'result' => 'string',
            'file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:10240',
        ]);
        $labTest = LabTest::findOrFail($id);

        $labTest->status    = $request->status;
        $labTest->result    = $request->result;
        $labTest->file_path    = $request->file;

        if ($request->hasFile('file')) {
            $filePath           = LabTest::uploadFile($request, $labTest);
            $labTest->file_path = $filePath;
        }

        $labTest->save();

        return response()->json([
            'message' => 'Lab Test updated successfully!',
            'labTest' => $labTest,
        ]);
    }

    public function destroy($id)
    {
        $labTest = LabTest::findOrFail($id);

        if ($labTest->image && file_exists(public_path($labTest->image))) {
            unlink(public_path($labTest->image));
        }

        $labTest->delete();

        return response()->json([
            'message' => 'lab test deleted successfully!',
        ], 200);
    }
}
