<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Nurse;
use App\Models\Patient;
use App\Models\Treatment;
use App\Models\Task;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() 
    {
        $doctorCount = Doctor::count();
        $nurseCount = Nurse::count();
        $patientCount = Patient::count();
        $treatmentCount = Treatment::count();
        $pendingTasks = Task::where('status', 'pending')->count();


        $recentDoctors = Doctor::with('user')->latest()->take(5)->get();
        $recentPatients = Patient::with('user')->latest()->take(5)->get();
        $recentTreatments = Treatment::latest()->take(5)->get();

        return view('dashboard', compact(
            'doctorCount', 
            'nurseCount', 
            'patientCount', 
            'treatmentCount', 
            'pendingTasks', 
            'recentDoctors', 
            'recentPatients', 
            'recentTreatments'
        ));
    }
}

