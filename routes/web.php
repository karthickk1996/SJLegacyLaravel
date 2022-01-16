<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\WillFormController;
use Illuminate\Support\Facades\Route;

\Illuminate\Support\Facades\Auth::routes();

Route::get('/', function () {
    return view('dashboard.homepage');
});

Route::group([], function () {
    Route::get('willform/create', [WillFormController::class, 'show'])->name('willform.show');
    Route::post('willform', [WillFormController::class, 'store'])->name('willform.store');
    Route::get('users', [\App\Http\Controllers\UsersController::class, 'index'])->name('users.show');
    Route::get('will/submissions', [\App\Http\Controllers\UsersController::class, 'index'])->name('willform.submissions');
});
