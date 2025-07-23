<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentController;

Route::get('/', function () {
    return view('rotas');
});

Route::post('create-student', [StudentController::class, 'index']);