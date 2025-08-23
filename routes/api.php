<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AreaController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\StudyingController;
use App\Http\Controllers\Api\CertificateController;
use App\Http\Controllers\Api\ConnectionsController;
use App\Http\Controllers\Api\InstitutionController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Api\ExperienceAndProjectController;

Route::apiResource('students', StudentController::class)->except(['update', 'store']);

Route::apiResource('courses', CourseController::class);

Route::apiResource('institutions', InstitutionController::class);

Route::apiResource('studying', StudyingController::class);

Route::apiResource('project-and-experience', ExperienceAndProjectController::class);

Route::apiResource('certificates', CertificateController::class);

// rota pública
Route::get('/companies', [CompanyController::class, 'index']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/company', [CompanyController::class, 'show']);
    Route::post('/company', [CompanyController::class, 'store']);
    Route::put('/company', [CompanyController::class, 'update']);
    Route::delete('/company', [CompanyController::class, 'destroy']);
});

Route::apiResource('address', AddressController::class);

Route::apiResource('areas', AreaController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/students', [StudentController::class, 'store']);
});

Route::prefix('students/update')->group(function () {

    Route::middleware('auth:sanctum')->group(function () {
        Route::put('/profile', [StudentController::class, 'updateAuthenticated']);

        Route::post('/experience', [ExperienceAndProjectController::class, 'storeAuthenticated']);
        Route::put('/experience/{experience}', [ExperienceAndProjectController::class, 'updateAuthenticated']);
        Route::delete('/experience/{experience}', [ExperienceAndProjectController::class, 'destroyAuthenticated']);

        Route::post('/certificate', [CertificateController::class, 'storeAuthenticated']);
        Route::put('/certificate/{certificate}', [CertificateController::class, 'updateAuthenticated']);
        Route::delete('/certificate/{certificate}', [CertificateController::class, 'destroyAuthenticated']);

        Route::post('/studying', [StudyingController::class, 'storeAuthenticated']);
        Route::put('/studying/{studying}', [StudyingController::class, 'updateAuthenticated']);
        Route::delete('/studying/{studying}', [StudyingController::class, 'destroyAuthenticated']);
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/connections', [ConnectionsController::class, 'index']);
    Route::post('/connections', [ConnectionsController::class, 'store']);
    Route::put('/connections/{connection}', [ConnectionsController::class, 'update']);
    Route::delete('/connections/{connection}', [ConnectionsController::class, 'destroy']);
});

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