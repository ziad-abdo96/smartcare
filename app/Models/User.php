<?php
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Concerns\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'date_of_birth',
        'phone',
        'image',
        'type',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hasAbility($ability)
    {
        return $this->roles()
            ->whereHas('abilities', function ($query) use ($ability) {
                $query->where('ability', $ability)->where('type', 'allow');
            })->exists();
    }
    
    public static function rules($id = 0)
    {

        return [
            'name'          => 'required|string|min:3|max:255',
            'email'         => "required|email|unique:users,email,$id",
            'password'      => 'required|string|min:8',
            'gender'        => 'required|in:male,female',
            'date_of_birth' => 'nullable|date',
            'phone'         => 'nullable|string|max:20',
            'image'         => 'nullable|image|mimes:jpg,png|max:1048576|dimensions:min_width=100,min_height=100',
        ];
    }

    public static function createWithDoctor(Request $request, $imagePath = null)
    {
        $user = User::create([
            'name'          => $request->post('name'),
            'email'         => $request->post('email'),
            'password'      => Hash::make($request->post('password')),
            'type'          => 'doctor',
            'date_of_birth' => $request->post('date_of_birth'),
            'phone'         => $request->post('phone'),
            'gender'        => $request->post('gender'),
            'image'         => $imagePath,
        ]);

        $doctor = Doctor::create([
            'user_id'       => $user->id,
            'department_id' => $request->input('department_id'),
            'about'         => $request->post('about'),
            'specialty'     => $request->post('specialty'),
        ]);
        return $user;

    }

    public static function createWithNurse(Request $request, $imagePath = null)
    {
        $user = User::create([
            'name'          => $request->post('name'),
            'email'         => $request->post('email'),
            'password'      => Hash::make($request->post('password')),
            'type'          => 'nurse',
            'date_of_birth' => $request->post('date_of_birth'),
            'phone'         => $request->post('phone'),
            'gender'        => $request->post('gender'),
            'image'         => $imagePath,
        ]);

        Nurse::create([
            'user_id'             => $user->id,
            'experience_of_years' => $request->post('experience_of_years'),
        ]);

        return $user;
    }

    public static function createWithPatient(Request $request, $imagePath = null, $entryDate = null)
    {
        $user = User::create([
            'name'          => $request->post('name'),
            'email'         => $request->post('email'),
            'password'      => Hash::make($request->post('password')),
            'type'          => 'patient',
            'date_of_birth' => $request->post('date_of_birth'),
            'phone'         => $request->post('phone'),
            'gender'        => $request->post('gender'),
            'image'         => $imagePath,
        ]);
        Patient::create([
            'user_id'                  => $user->id,
            'doctor_id'                => $request->post('doctor_id'),
            'city'                     => $request->post('city'),
            'street'                   => $request->post('street'),
            'entry_date'               => $entryDate,
            'blood_type'               => $request->post('blood_type'),
            'national_id'              => $request->post('national_id'),
            'description_of_condition' => $request->post('description_of_condition'),
            'room_number'              => $request->post('room_number'),
        ]);
        return $user;
    }
    public static function createAdmin(Request $request, $imagePath = null)
    {
        $user = User::create([
            'name'          => $request->post('name'),
            'email'         => $request->post('email'),
            'password'      => Hash::make($request->post('password')),
            'type'          => 'admin',
            'date_of_birth' => $request->post('date_of_birth'),
            'phone'         => $request->post('phone'),
            'gender'        => $request->post('gender'),
            'image'         => $imagePath,
        ]);

        return $user;
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

    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }

    public function nurse()
    {
        return $this->hasOne(Nurse::class);
    }

    public function patient()
    {
        return $this->hasOne(Patient::class);
    }


    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function assignRole($role)
    {
        return $this->roles()->attach($role);
    }

    public function removeRole($role)
    {
        return $this->roles()->detach($role);
    }

    public function hasRole($roleName)
    {
        return $this->roles()->where('name', $roleName)->exists();
    }

}
