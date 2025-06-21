<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\InstitutionController;
use App\Http\Controllers\AuthController;

Route::apiResource('students', StudentController::class);

Route::apiResource('courses', CourseController::class);

Route::apiResource('institutions', InstitutionController::class);


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->get('/teste', function (Request $request) {
    return response()->json([
        'message' => 'Acesso autorizado',
        'user' => $request->user(),
    ]);
});