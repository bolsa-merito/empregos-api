<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\StudyingController;
use App\Http\Controllers\Api\CertificateController;
use App\Http\Controllers\Api\InstitutionController;
use App\Http\Controllers\Api\ExperienceAndProjectController;

Route::apiResource('students', StudentController::class);

Route::apiResource('courses', CourseController::class);

Route::apiResource('institutions', InstitutionController::class);

Route::apiResource('studying', StudyingController::class);

Route::apiResource('project-and-experience', ExperienceAndProjectController::class);

Route::apiResource('certificates', CertificateController::class);

Route::apiResource('company', CompanyController::class);

Route::apiResource('address', AddressController::class);