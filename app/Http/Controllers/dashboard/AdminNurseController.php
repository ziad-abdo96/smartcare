<?php
namespace App\Http\Controllers\dashboard;

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
        return view('dashboard.nurses.index', compact('nurses'));
    }

    
    public function create()
    {
        $nurse = new Nurse();
        return view('dashboard.nurses.create', compact('nurse'));
    }

   
    public function store(Request $request)
    {
        $request->validate(Nurse::rules());

        $imagePath = Nurse::uploadImage($request);

        $user = User::createWithNurse($request, $imagePath);

        return redirect()->route('dashboard.nurses.index')->with('success', 'The nurse stored successfully');
    }

    public function show($id)
    {
        $this->authorize('nurse.view');
        
    }

  
    public function edit($id)
    {
        $this->authorize('nurse.update');
        $nurse = Nurse::findWithUser($id);
        return view('dashboard.nurses.edit', compact('nurse'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('nurse.update');
        $nurse = Nurse::findWithUser($id);
        $request->validate(Nurse::rules($nurse->user->id), [
            'image' => 'this field is not image',
        ]);

        $imagePath = Nurse::uploadImage($request, $nurse);

        $userData = $nurse->update([
            'name'          => $request->post('name'),
            'email'         => $request->post('email'),
            'password'      => Hash::make($request->post('password')),
            'type'          => 'nurse',
            'date_of_birth' => $request->post('date_of_birth'),
            'phone'         => $request->post('phone'),
            'gender'        => $request->post('gender'),
        ]);

        if ($imagePath) {
            $nurse->user->image = $imagePath;
            $nurse->user->save();
        }
        $nurse->update([
            'about'         => $request->post('about'),
            'experience_of_years'     => $request->post('experience_of_years'),
        ]);

        return redirect()->route('dashboard.nurses.index')->with('success', 'Nurse updated successfully');
    }

  
    public function destroy($id)
    {
        $this->authorize('nurse.delete');
        $nurse = Nurse::findOrFail($id);

        if ($nurse->user->image && file_exists(public_path($nurse->user->image))) {
            unlink(public_path($nurse->user->image));
        }

        $deleted = $nurse->delete();
        
        return $deleted
        ? redirect()->back()->with('success', 'the nurse deleted successfully!')
        : redirect()->back()->with('error', 'the nurse not found');
    }
}
