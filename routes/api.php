<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\InstitutionController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\EmailVerificationController;

Route::apiResource('students', StudentController::class);

Route::apiResource('courses', CourseController::class);

Route::apiResource('institutions', InstitutionController::class);


// Rotas de autenticação
Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    
    // Rotas protegidas por autenticação
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/user', [AuthController::class, 'user']);
        
        // Verificação de email
        Route::post('/email/verification-notification', [EmailVerificationController::class, 'send'])
            ->middleware('throttle:6,1')
            ->name('verification.send');
        
        // Rota GET para quando usuário clica no email (protegida)
        Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verifyViaGet'])
            ->middleware('signed')
            ->name('verification.verify');
            
        // Rota POST para verificação via API
        Route::post('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
            ->middleware('signed')
            ->name('verification.verify.post');
    });
});

// Rota GET para verificar email (quando usuário clica no link do email)
Route::get('/api/auth/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verifyViaGet'])
    ->middleware(['signed'])
    ->name('verification.verify.get');

// Rotas protegidas que exigem email verificado
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/protected-route', function () {
        return response()->json(['message' => 'Esta rota requer email verificado']);
    });
});