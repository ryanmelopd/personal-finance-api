<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContaController;

Route::get('/contas', [ContaController::class, 'index']);
