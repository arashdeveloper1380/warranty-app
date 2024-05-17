<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Categories\CategoryController;
use App\Livewire\Categories\CreateCategoryController;
use App\Livewire\DashboardController;
use App\Livewire\HomeController;
use App\Livewire\Products\CreateProductController;
use App\Livewire\Products\ProductController;
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

Route::get('/', HomeController::class);

Route::prefix('/dashboard')->group(function(){

    Route::get('/', DashboardController::class)->name('dashboard.index');

    Route::prefix('category')->group(function(){
        Route::get('/', CategoryController::class)->name('category.index');
        Route::get('/create', CreateCategoryController::class)->name('category.create');
    });

    Route::prefix('product')->group(function(){
        Route::get('/', ProductController::class)->name('product.index');
        Route::get('/create', CreateProductController::class)->name('product.create');
    });
    

})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';

Route::get('register', function () {
    return redirect('/');
});