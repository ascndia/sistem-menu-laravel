<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DisplayController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\GroupController;
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

Route::get('/',[DisplayController::class, 'index']);
Route::prefix('menu')->group(function(){
    Route::get('/',[DisplayController::class, 'group']);
    Route::get('/{groupid}',[DisplayController::class, 'items']);
    Route::get('/item/{itemid}',[DisplayController::class, 'show']);
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->middleware(['auth','verified'])->group(function(){
    Route::get('dashboard',[AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('group',[GroupController::class]);
    Route::post('/group/{group}/toggle-showing',[GroupController::class, 'toggleShowing'])->name('group.toggleShowing');
    Route::resource('item',[ItemController::class])->except(['show','create','edit']);
    Route::post('/item/{item}/toggle-showing',[ItemController::class, 'toggleShowing'])->name('item.toggleShowing');
});



require __DIR__.'/auth.php';
