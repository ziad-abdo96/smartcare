<?php
namespace App\Http\Controllers;

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
        $patient    = Patient::findOrFail($id);
        $treatments = Treatment::where('patient_id', $id)->get();
        return view('front.patient.treatments.index', compact('patient', 'treatments'));
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

        return redirect()->back()->with('success', 'Treatment created successfully!');
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

        return redirect()->route('treatments.index', $treatment->patient_id)->with('success', 'this Treatment is updated successfully');
    }

    public function destroy($id)
    {
        $treatment = Treatment::findOrFail($id);

        if ($treatment->image && file_exists(public_path($treatment->image))) {
            unlink(public_path($treatment->image));
        }

        $treatment->delete();

        return redirect()->back()->with('success', 'Treatment deleted successfully.');
    }

}
