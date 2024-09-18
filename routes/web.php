<?php
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

$admin = 'role:admin';

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/category', [CategoryController::class, 'index'])->middleware(['auth', $admin])->name('category.index');

Route::middleware(['auth', $admin])->group(function () {
    // Route::get('/admin', function() {
    //     return view('admin.index');
    // });

    Route::resource('categories', CategoryController::class);
    
    Route::resource('books', BookController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

