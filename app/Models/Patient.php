<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'doctor_id',
        'city',
        'street',
        'entry_date',
        'blood_type',
        'national_id',
        'description_of_condition',
        'room_number',
    ];

    protected $hidden = ['password'];
    public static function rules($id = 0, $user_id = 0)
    {
        return [
            'name'          => 'required|string|min:3|max:255',
            'email'         => "required|email|unique:users,email,$user_id",
            'gender'        => 'required|in:male,female',
            'date_of_birth' => 'nullable|date',
            'phone'         => 'nullable|string|max:20',
            'image'         => 'nullable|image|mimes:jpg,png|max:1048576|dimensions:min_width=100,min_height=100',
            'doctor_id'     => 'required|exists:doctors,id',
            'city'          => 'nullable|string|max:255',
            'street'        => 'nullable|string|max:255',
            'entry_date'    => 'required|date',  
            'blood_type'    => 'required|in:A+,A-,B+,B-,AB+,AB-,O+,O-',  
            'national_id'   => "string|max:20|unique:patients,national_id,$id", 
            'description_of_condition' => 'nullable|string',
            'room_number'   => 'nullable|string|max:20',
        ];
    }
    
    public static function uploadImage($request, $patient = null)
    {
        if (! $request->hasFile('image')) {
            return;
        }
        if (isset($patient->user->image) && file_exists(public_path($patient->user->image))) {
            unlink(public_path($patient->user->image));
        }

        $image          = $request->file('image');
        $imageExtension = $image->getClientOriginalExtension();
        $newImageName   = uniqid() . '.' . $imageExtension;
        $image->move(public_path('assets/images'), $newImageName);
        $imagePath = "assets/images/{$newImageName}";
        return $imagePath;
    }

    public function scopeWithUser(Builder $builder)
    {
        return $builder->with('user');
    }

    public function scopeFindWithUser(Builder $builder, $id)
    {
        return $builder->with('user')->findOrFail($id);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function treatments()
    {
        return $this->hasMany(Treatment::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function labTests()
    {
        return $this->hasMany(LabTest::class);
    }

    public function diagnoses()
    {
        return $this->hasMany(Diagnosis::class);
    }
}
