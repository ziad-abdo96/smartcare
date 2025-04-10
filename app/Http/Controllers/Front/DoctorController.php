<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    public function patients()
    {
        $user_id = Auth::id();

        $doctor = Doctor::where('user_id', $user_id)->first();

        if (! $doctor) {
            return redirect()->back()->with('error', 'Doctor not found.');
        }

        $patients = Patient::with('user')
            ->where('doctor_id', $doctor->id)
            ->get();

        return view('front.doctor.patients', compact('patients'));
    }

    public function profile()
    {
        $user_id = Auth::id();
        $doctor = Doctor::where('user_id', $user_id)->first();
        return view('front.doctor.profile', compact('doctor'));
    }
}
