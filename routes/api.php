
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); 

require_once __DIR__ . '/api/dashboard/home.php';
require_once __DIR__ . '/api/dashboard/doctor.php';
require_once __DIR__ . '/api/dashboard/nurse.php';
require_once __DIR__ . '/api/dashboard/patient.php';
require_once __DIR__ . '/api/dashboard/department.php';
require_once __DIR__ . '/api/dashboard/role.php';
require_once __DIR__ . '/api/dashboard/ability.php';


require_once __DIR__ . '/api/front/auth.php';
require_once __DIR__ . '/api/front/doctor.php';
require_once __DIR__ . '/api/front/nurse.php';
require_once __DIR__ . '/api/front/patient.php';
require_once __DIR__ . '/api/front/task.php';
require_once __DIR__ . '/api/front/treatment.php';
require_once __DIR__ . '/api/front/lab_test.php';
require_once __DIR__ . '/api/front/diagnosis.php';

