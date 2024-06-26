<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/product', [ProductController::class, 'index'])->name('product');

Route::get('/dashboard', function (Request $request) {
    return view('dashboard',[
        'clients' => $request->user()->clients
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');


// Route::get('/product', function () {
//     return view('product');
// })->middleware(['auth', 'verified'])->name('product');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
