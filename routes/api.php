<?php

use App\Http\Controllers\MotorInstallmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/motors/{motor}/installments', [MotorInstallmentController::class, 'index']);
