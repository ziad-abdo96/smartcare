<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'department_id',
        'specialty',
        'about',
    ];

    public static function rules($id = 0)
    {

        return [
            'name'          => 'required|string|min:3|max:255',
            'email'         => "required|email|unique:users,email,$id",
            'password'      => 'required|string|min:8',
            'gender'        => 'required|in:male,female',
            'date_of_birth' => 'nullable|date',
            'phone'         => 'nullable|string|max:20',
            'specialty'     => 'nullable|string',
            'about'         => 'nullable|string',
            'image'         => 'nullable|image|mimes:jpg,png|max:1048576|dimensions:min_width=100,min_height=100',
            'department_id' => 'nullable|exists:departments,id',
        ];
    }

    public static function uploadImage($request, $doctor = null)
    {
        if (! $request->hasFile('image')) {
            return;
        }
        if (isset($doctor->user->image) && file_exists(public_path($doctor->user->image))) {
            unlink(public_path($doctor->user->image));
        }

        $image          = $request->file('image');
        $imageExtension = $image->getClientOriginalExtension();
        $newImageName   = uniqid() . '.' . $imageExtension;
        $image->move(public_path('assets/images'), $newImageName);
        $imagePath = "assets/images/{$newImageName}";
        return $imagePath;
    }


    public function scopeFindWithUser(Builder $builder, $id)
    {
        return $builder->with('user')->findOrFail($id);
    }

    public function scopeWithUser(Builder $builder)
    {
        return $builder->with('user');
    }

    //Accessor
    public function getImageUrlAttribute()
    {
        return $this->user->gender === 'male'
        ? 'https://www.livemed.com.ng/medfiles/med-general/img/male.jpg'
        : 'https://img.freepik.com/premium-vector/avatar-woman-doctor-with-brown-hair-doctor-with-stethoscope-vector-illustrationxa_276184-34.jpg';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function patients()
    {
        return $this->hasMany(Patient::class);
    }

    public function department()
    {
        return $this->hasOne(Department::class)->withDefault([
            'name' => '-',
        ]);
    }
}
