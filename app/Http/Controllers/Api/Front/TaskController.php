<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Task;
use App\Models\User;
use App\Notifications\TaskNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Notification;


class TaskController extends Controller
{
    public function show($id)
    {
        $patient = Patient::with(['user', 'tasks'])->findOrFail($id);
    
        return response()->json([
            'patient' => $patient,
            'tasks' => $patient->tasks,
        ], 200);
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

        return response()->json([
            'message' => 'Task created successfully!',
            'task'    => $task
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
    
        $request->validate([
            'status' => 'required|in:completed,pending',
            'result' => 'nullable|string',
            'file'   => 'nullable|mimes:jpg,jpeg,png,pdf|max:10240',
        ]);
    
        $task->update($request->only(['status', 'result']));
    
        if ($request->hasFile('file')) {
            $filePath = Task::uploadFile($request, $task);
            $task->update(['file_path' => $filePath]);
        }
    
        return response()->json([
            'message' => 'Task updated successfully!',
            'task'    => $task
        ], 200);
    }
    
   
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
    
        return response()->json([
            'message' => 'Task deleted successfully!',
            'task_id' => $id
        ], 200);
    }
    
}

