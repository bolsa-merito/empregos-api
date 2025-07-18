<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\InstitutionController;

Route::apiResource('students', StudentController::class);

Route::apiResource('courses', CourseController::class);

Route::apiResource('institutions', InstitutionController::class);