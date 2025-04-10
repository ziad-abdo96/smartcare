<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;

class AbilityController extends Controller
{
    public function index()
    {
        $abilities = config('abilities');

        return response()->json([
            'abilities' => $abilities,
        ], 200);
    }
}
