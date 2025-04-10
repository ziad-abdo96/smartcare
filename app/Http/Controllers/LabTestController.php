<?php
namespace App\Http\Controllers;

use App\Models\LabTest;
use App\Models\Patient;
use App\Models\User;
use App\Notifications\LabTestNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Notification;

class LabTestController extends Controller
{
    public function index($id)
    {
        $patient  = Patient::findOrFail($id);
        $labTests = LabTest::where('patient_id', $id)->get();

        return view('front.patient.lab_tests.index', compact('patient', 'labTests'));
    }

    public function store(Request $request)
    {
        $request->validate([
          //  'status' => 'required|in:completed,pending',
            'result' => 'string',
            'file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:10240',
        ]);

        $testDate = Carbon::parse($request->due_date)->format('Y-m-d');

        $testTime = Carbon::parse($request->due_time)->format('H:i');

        $labTest = LabTest::create([
            'patient_id' => $request->patient_id,
            'name'       => $request->name,
            'due_date'   => $testDate,
            'due_time'   => $testTime,
            'result'     => $request->result,
        ]);
        $nurses = User::where('type', 'nurse')->get();

        Notification::send($nurses, new LabTestNotification($labTest));

        return redirect()->back()->with('success', 'Lab test added successfully.');
    }
    public function update(Request $request, $id)
    {

        $request->validate([
            'status' => 'required|in:completed,pending',
            'result' => 'string',
            'file'   => 'nullable|mimes:jpg,jpeg,png,pdf|max:10240',
        ]);

        $labTest         = LabTest::findOrFail($id);
        $labTest->status = $request->status;
        $labTest->result = $request->result;

        if ($request->hasFile('file')) {
            $filePath           = LabTest::uploadFile($request, $labTest);
            $labTest->file_path = $filePath;
        }

        $labTest->save();
        return redirect()->route('tasks.index', $labTest->patient_id)->with('success', 'this lab Test is updated successfully');
    }

    public function destroy($id)
    {
        $labTest = LabTest::findOrFail($id);

        if ($labTest->image && file_exists(public_path($labTest->image))) {
            unlink(public_path($labTest->image));
        }

        $labTest->delete();

        return redirect()->back()->with('success', 'Lab test deleted successfully.');
    }
}
