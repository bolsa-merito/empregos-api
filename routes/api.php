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
use App\Http\Controllers\Api\FormationController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\BenefitsEnterpriseController;
use App\Http\Controllers\CompanyInfoController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\DescriptionController;

Route::apiResource('students', StudentController::class);

Route::apiResource('courses', CourseController::class);

Route::apiResource('formations', FormationController::class);

Route::apiResource('profiles', ProfileController::class);

Route::apiResource('institutions', InstitutionController::class);

Route::apiResource('studying', StudyingController::class);

Route::apiResource('experience-and-project', ExperienceAndProjectController::class);

Route::apiResource('certificates', CertificateController::class);

Route::apiResource('company', CompanyController::class);

Route::apiResource('address', AddressController::class);

Route::apiResource('proposal', ProposalController::class);

Route::apiResource('benefits-enterprise', BenefitsEnterpriseController::class);

Route::apiResource('company-info', CompanyInfoController::class);

Route::apiResource('projects', ProjectController::class);

Route::apiResource('descriptions', DescriptionController::class);
