<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
        'patient_id',
        'due_date',
        'due_time',
        'result',
        'file_path',
    ];

    public static function rules()
    {
        return [
            'name'       => 'required',
            'description' => 'nullable',
            'due_date'    => 'required|date|after_or_equal:today', 
            'due_time'    => 'required|date_format:H:i',
            'patient_id'  => 'required|exists:patients,id',
            'file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:10240',
        ];
    }

    public static function uploadFile($request, $task = null)
    {
        if (! $request->hasFile('file')) {
            return;
        }
        if (isset($task->file) && file_exists(public_path($task->file))) {
            unlink(public_path($task->file));
        }

        $file          = $request->file('file');
        $fileExtension = $file->getClientOriginalExtension();
        $newImageName   = uniqid() . '.' . $fileExtension;
        $file->move(public_path('assets/files'), $newImageName);
        $filePath = "assets/files/{$newImageName}";
        

        return $filePath;
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
