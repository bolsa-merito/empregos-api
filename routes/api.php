<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\ExperienceAndProjectController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\InstitutionController;
use App\Http\Controllers\Api\StudyingController;

Route::apiResource('students', StudentController::class);

Route::apiResource('courses', CourseController::class);

Route::apiResource('institutions', InstitutionController::class);

Route::apiResource('studying', StudyingController::class);

Route::apiResource('project-and-experience', ExperienceAndProjectController::class);