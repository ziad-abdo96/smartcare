<?php
namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Models\Nurse;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;

class NurseController extends Controller
{
    public function patients()
    {
        $patients = Patient::with('user')->get();

        return response()->json([
            'patients' => $patients ?? 'patient not found',
        ], 200);

    }

    public function profile()
    {
        $user_id = Auth::id();
        $nurse   = Nurse::with('user')->where('user_id', $user_id)->first();

        if (! $nurse) {
            return response()->json([
                'message' => 'Nurse not found',
            ], 404);
        }

        return response([
            'nurse' => $nurse,
        ], 200);
    }
}
