<?php
namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Models\Patient;

class PatientController extends Controller
{

    public function index($id)
    {
        try {
            $patient = Patient::with('user')->findOrFail($id);

            return response()->json([
                'patient' => $patient,
            ], 200);

        } catch (\Exception $e) {return response()->json([
            'message' => 'Failed to retrieve patient.',
            'error'   => $e->getMessage(),
        ], 500);}
    }

}
