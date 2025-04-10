<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Nurse;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NurseController extends Controller
{
    public function patients()
    {
        $patients = Patient::all();

        return view('front.nurse.patients', compact('patients'));
    }

    public function profile()
    {
        $user_id = Auth::id();
        $nurse = Nurse::where('user_id', $user_id)->first();
        return view('front.nurse.profile', compact('nurse'));
    }
}
