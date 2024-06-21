<?php

use App\Http\Controllers\EditadminController;
use App\Http\Controllers\ProfileController;
use App\Livewire\Admins\AdminController;
use App\Livewire\Admins\CreateAdminController;

use App\Livewire\Categories\CategoryController;
use App\Livewire\Categories\CreateCategoryController;
use App\Livewire\Categories\CreateDefaultProdutController;
use App\Livewire\Categories\EditCategoryController;
use App\Livewire\DashboardController;
use App\Livewire\Categories\DefaultProductController;
use App\Livewire\HomeController;
use App\Livewire\Products\CreateProductController;
use App\Livewire\Products\ProductController;
use App\Models\DefaultProduct;
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

Route::prefix('/dashboard')->middleware('is_login')->group(function(){

    Route::get('/', DashboardController::class)->name('dashboard.index');

    Route::prefix('category')->group(function(){
        Route::get('/', CategoryController::class)->name('category.index');
        Route::get('/create', CreateCategoryController::class)->name('category.create');
        Route::get('/edit/{id}', EditCategoryController::class)->name('category.edit');

        Route::get('/default-product', DefaultProductController::class)->name('default-product.index');
        Route::get('/create-default-product', CreateDefaultProdutController::class)->name('default-product.create');
        

    });

    Route::prefix('product')->group(function(){
        Route::get('/', ProductController::class)->name('product.index');
        Route::get('/create', CreateProductController::class)->name('product.create');
    });

    Route::prefix('admin')->group(function(){
        Route::get('/', AdminController::class)->name('admin.index');
        Route::get('/create', CreateAdminController::class)->name('admin.create');
        Route::get('/edit/{id}', [EditadminController::class, 'edit']);
        Route::put('/update/{id}', [EditadminController::class, 'update'])->name('admin.update');
    });
    

})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';

// Route::get('register', function () {
//     return redirect('/');
// });