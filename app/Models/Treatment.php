<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'due_date', 'due_time', 'file', 'patient_id', 'status'];

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

    public static function uploadFile($request, $treatment = null)
    {
        if (! $request->hasFile('file')) {
            return;
        }
        if (isset($treatment->file) && file_exists(public_path($treatment->file))) {
            unlink(public_path($treatment->file));
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
        return $this->belongsTo(Treatment::class);
    }
}
