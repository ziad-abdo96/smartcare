<?php
namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Nurse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminNurseController extends Controller
{
   
    public function index()
    {
        $this->authorize('nurse.view');
        $nurses = Nurse::withUser()->get();
        return response()->json($nurses);
    }

    public function store(Request $request)
    {
        $this->authorize('nurse.create');
        $request->validate(Nurse::rules());

        $imagePath = Nurse::uploadImage($request);

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

        $nurse = Nurse::create([
            'user_id'             => $user->id,
            'experience_of_years' => $request->post('experience_of_years'),
        ]);

        return response()->json($nurse, 201);
    }

    
    public function show($id)
    {
        $this->authorize('nurse.view');
        $nurse = Nurse::findWithUser($id);
        return response()->json($nurse);
    }

   
    public function update(Request $request, $id)
    {
        $this->authorize('nurse.update');
        $nurse = Nurse::findWithUser($id);
        $request->validate(Nurse::rules($nurse->user->id));

        $imagePath = Nurse::uploadImage($request, $nurse);

        $nurse->user->update([
            'name'          => $request->post('name'),
            'email'         => $request->post('email'),
            'password'      => Hash::make($request->post('password')),
            'type'          => 'nurse',
            'date_of_birth' => $request->post('date_of_birth'),
            'phone'         => $request->post('phone'),
            'gender'        => $request->post('gender'),
            'image'         => $imagePath,
        ]);

        $nurse->update([
            'about'         => $request->post('about'),
            'experience_of_years'     => $request->post('experience_of_years'),
        ]);

        return response()->json($nurse);
    }

    
    public function destroy($id)
    {
        $this->authorize('nurse.delete');
        $nurse = Nurse::findOrFail($id);

        if ($nurse->user->image && file_exists(public_path($nurse->user->image))) {
            unlink(public_path($nurse->user->image));
        }

        $nurse->delete();
        
        return response()->json(null, 204);
    }
}