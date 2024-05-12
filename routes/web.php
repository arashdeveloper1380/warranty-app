<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Categories\CategoryController;
use App\Livewire\CreateCategoryController;
use App\Livewire\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/dashboard')->group(function(){

    Route::get('/', DashboardController::class)->name('dashboard.index');

    Route::prefix('category')->group(function(){
        Route::get('/', CategoryController::class)->name('category.index');
        Route::get('/create', CreateCategoryController::class)->name('category.create');
    });
    

})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
