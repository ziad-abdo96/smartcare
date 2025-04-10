<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class AccessTokensController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email'       => 'required|email|max:255',
            'password'    => 'required|string',
            //'device_name' => 'string|max:255',
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {

            $device_name = $request->post('device_name', $request->userAgent());

            $token = $user->createToken($device_name); //token_object

            return response()->json([
                'token' => $token->plainTextToken,
                'user'  => $user,
            ], 201);
        }

        return response()->json([
            'message' => 'Invalid credentials',
        ], 401); // 401 Unauthorized
    }

    public function destroy($token = null)
    {
        $user = Auth::guard('sanctum')->user();

        if ($token == null) {
            $user->currentAccessToken()->delete();
            return response()->json(['message' => 'Logged out successfully']);
        }

        $personalAccessToken = PersonalAccessToken::findToken($token);

        if (! $personalAccessToken || $user->id != $personalAccessToken->tokenable_id) {
            return response()->json(['message' => 'Token not found or unauthorized'], 403);
        }

        $personalAccessToken->delete();
        return response()->json(['message' => 'Token deleted successfully']);
    }

    public function destroyAllToken()
    {
        $user = Auth::guard('sanctum')->user();
        
        if(!$user) {
           return response()->json(['message' => 'Unauthorized: No user found'], 401);
        }

        $user->tokens()->delete();
        return response()->json(['message' => 'Token deleted successfully']);
    }

}
