<?php
namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function patients()
    {
        $user_id = Auth::id();
        $doctor  = Doctor::with('user')->where('user_id', $user_id)->first();

        if (! $doctor) {
            return response()->json([
                'message' => 'Doctor not found.',
            ], 404);
        }

        $patients = Patient::with('user')
            ->where('doctor_id', $doctor->id)
            ->get();

        return response()->json([
            'success'  => true,
            'patients' => $patients,
        ], 200);


    }

    public function profile()
    {
        $user_id = Auth::id();
        $doctor = Doctor::with('user')->where('user_id', $user_id)->first();

        if (! $doctor) {
            return response()->json([
                'message' => 'Doctor not found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'doctor' => $doctor
        ], 200);
    }
}
