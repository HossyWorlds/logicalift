<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MenuController;
use App\Http\Controllers\FriendController;

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

//Route::get('/', function () {
  //  return view('welcome');
//});

Route::get('/dashboard', [MenuController::class, 'home'])
->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard/appExplanation', function(){
    return view('appExplanation');
})->name('appExplanation');

Route::controller(MenuController::class)->middleware(['auth'])->group(function(){
    Route::get('/', 'index')->name('index');
    Route::get('/menus/admin', 'admin')->name('admin');
    Route::post('/menus','store')->name('store');
    Route::post('/menus/add','add')->name('add');
    Route::get('/menus/{menu}', 'show')->name('show');
    Route::post('/menus/{menu}/done', 'done')->name('done');
    Route::get('/menus/{menu}/memo', 'memo')->name('memo');
    Route::put('/menus/{menu}', 'update')->name('update');
    Route::delete('menus/{menu}/reset', 'reset')->name('reset');
    Route::post('/menus/{menu}/remove', 'remove')->name('remove');
    Route::delete('/menus/{menu}', 'delete')->name('delete');
    Route::get('/menus/{menu}/edit', 'edit')->name('edit');
});

Route::controller(FriendController::class)->middleware(['auth'])->group(function(){
    Route::get('/friends', 'friends')->name('friends');
    Route::get('/friends/adminFriend', 'adminFriend')->name('adminFriend');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

