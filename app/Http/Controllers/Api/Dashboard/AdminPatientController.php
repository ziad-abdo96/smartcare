<?php
namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminPatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $this->authorize('patient.view');
        $patients = Patient::with('user')->get();
        return response()->json($patients);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $this->authorize('patient.create');
        $request->validate(Patient::rules());

        $imagePath = Patient::uploadImage($request);
        $entryDate = Carbon::parse($request->entry_date)->format('Y-m-d');

        $randomPassword = Str::random(8);
        $user = User::create([
            'name'          => $request->post('name'),
            'email'         => $request->post('email'),
            'password'      => Hash::make($randomPassword),
            'type'          => 'patient',
            'date_of_birth' => $request->post('date_of_birth'),
            'phone'         => $request->post('phone'),
            'gender'        => $request->post('gender'),
            'image'         => $imagePath,
        ]);

        $patient = Patient::create([
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

        return response()->json($patient, 201);
    }


    public function show($id)
    {
        $this->authorize('patient.view');
        $patient = Patient::with('user')->findOrFail($id);
        return response()->json($patient);
    }


    public function update(Request $request, $id)
    {
        $this->authorize('patient.update');
        $patient = Patient::with('user')->findOrFail($id);
        $request->validate(Patient::rules($patient->id, $patient->user->id));

        $imagePath = Patient::uploadImage($request, $patient);
        $entryDate = Carbon::parse($request->entry_date)->format('Y-m-d');

        $patient->user->update([
            'name'          => $request->post('name'),
            'email'         => $request->post('email'),
            'type'          => 'patient',
            'date_of_birth' => $request->post('date_of_birth'),
            'phone'         => $request->post('phone'),
            'gender'        => $request->post('gender'),
        ]);

        if ($imagePath) {
            $patient->user->image = $imagePath;
            $patient->user->save();
        }

        $patient->update([
            'doctor_id'                => $request->post('doctor_id'),
            'city'                     => $request->post('city'),
            'street'                   => $request->post('street'),
            'entry_date'               => $entryDate,
            'blood_type'               => $request->post('blood_type'),
            'national_id'              => $request->post('national_id'),
            'description_of_condition' => $request->post('description_of_condition'),
            'room_number'              => $request->post('room_number'),
        ]);

        return response()->json($patient);
    }


    public function destroy($id)
    {

        $this->authorize('patient.delete');

        $patient = Patient::findOrFail($id);

        if ($patient->user->image && file_exists(public_path($patient->user->image))) {
            unlink(public_path($patient->user->image));
        }

        $patient->delete();

        return response()->json(null, 204);
    }
}