<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/',[WelcomeController::class,'index'])->name('welcome');

Route::get('/families/{family}',[FamilyController::class, 'show'])->name('families.show');

Route::get('/categories/{category}',[CategoryController::class, 'show'])->name('categories.show');

Route::get('/subcategories/{subcategory}',[\App\Http\Controllers\SubcategoryController::class, 'show'])->name('subcategories.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
