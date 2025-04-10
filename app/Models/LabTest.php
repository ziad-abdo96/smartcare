<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabTest extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'result', 'due_date','due_time' , 'status', 'file_path', 'patient_id'];

    public static function rules()
    {
        return [
            'patient_id' => 'required|exists:patients,id',
            'name' => 'required|string|max:255',
            'due_date' => 'required|date',
            'due_time' => 'required|date_format:H:i',
        ];
    }
    
      public static function uploadFile($request, $labTest = null)
    {
        if (! $request->hasFile('file')) {
            return;
        }
        if (isset($labTest->file) && file_exists(public_path($labTest->file))) {
            unlink(public_path($labTest->file));
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
