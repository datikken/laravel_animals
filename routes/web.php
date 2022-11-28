<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AnimalController;

Route::get('/', [IndexController::class, 'index']);

// API
Route::get('animal_kinds', [CategoryController::class, 'getCategories']);
Route::get('animals/{slug}', [CategoryController::class, 'getCategory']);

Route::post('animals', [AnimalController::class, 'create']);
Route::post('animals/age', [AnimalController::class, 'age']);

Route::post('kill_em_all', [AnimalController::class, 'killEmAll']);
