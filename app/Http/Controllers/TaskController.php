<?php
namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Task;
use App\Models\User;
use App\Notifications\TaskNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Notification;

class TaskController extends Controller
{
    public function index($id)
    {
        $patient = Patient::findOrFail($id);
        $tasks   = $patient->tasks;
        return view('front.patient.tasks.index', compact('patient', 'tasks'));
    }

    public function store(Request $request)
    {
        $request->validate(Task::rules());

        $due_date = Carbon::parse($request->due_date)->format('Y-m-d');

        $due_time = Carbon::parse($request->due_time)->format("H:i");

        $task = Task::create([
            'name'       => $request->name,
            'description' => $request->description,
            'due_date'    => $due_date,
            'due_time'    => $due_time,
            'patient_id'  => $request->patient_id,
        ]);

        $nurses = User::where('type', 'nurse')->get();

        Notification::send($nurses, new TaskNotification($task));

        return redirect()->back()->with('success', 'Task created successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:completed,pending',
            'result' => 'string',
            'file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:10240',
        ]);

        $task = Task::findOrFail($id);

        $task->update([
            'status' => $request->status,
            'result' => $request->result,
        ]);
        if ($request->hasFile('file')) {

            $filePath = Task::uploadFile($request, $task);
    
            $task->update([
                'file_path' => $filePath,
            ]);

        }

        return redirect()->route('tasks.index', $task->patient_id)->with('success', 'this task is updated successfully');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->back()->with('success', 'Task deleted successfully!');
    }

}
