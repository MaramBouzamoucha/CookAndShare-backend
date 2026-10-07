<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\MealPlanController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthController;


Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('registerForm');
Route::post('/register', [AuthController::class, 'registerBlade'])->name('registerBlade');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('loginForm');
Route::post('/login', [AuthController::class, 'loginBlade'])->name('loginBlade');
Route::get('/recipes', [RecipeController::class, 'indexBlade'])->name('recipes.indexBlade');

Route::post('/logout', [AuthController::class, 'logoutBlade'])->name('logoutBlade');
Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');


Route::get('/recipes', [RecipeController::class, 'indexBlade'])->name('recipes.indexBlade');
Route::get('/recipes/my', [RecipeController::class, 'myRecipesBlade'])->name('recipes.myBlade');
Route::get('/recipes/create', [RecipeController::class, 'createBlade'])->name('recipes.createBlade');
Route::post('/recipes', [RecipeController::class, 'store'])->name('recipes.store');
Route::get('/recipes/{id}', [RecipeController::class, 'showBlade'])->name('recipes.showBlade');

    Route::get('/recipes/{id}/edit', [RecipeController::class, 'edit'])->name('recipes.edit');
    Route::put('/recipes/{id}', [RecipeController::class, 'update'])->name('recipes.update');
    Route::delete('/recipes/{id}', [RecipeController::class, 'destroy'])->name('recipes.destroy');

Route::get('/mealplans', [MealPlanController::class, 'indexBlade'])->name('mealplans.index');
Route::get('/mealplans/create', [MealPlanController::class, 'createBlade'])->name('mealplans.create');
Route::post('/mealplans', [MealPlanController::class, 'store'])->name('mealplans.store');
Route::delete('/mealplans/{id}', [MealPlanController::class, 'destroy'])->name('mealplans.destroy');


Route::get('/favorites', [FavoritesController::class, 'indexBlade'])->name('favorites.index');

Route::post('/recipes/{recipeId}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
