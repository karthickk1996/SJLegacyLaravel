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

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\WillFormController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(['auth'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard.index');
    Route::get('willform/create', [WillFormController::class, 'show'])->name('willform.create');
    Route::post('willform', [WillFormController::class, 'store'])->name('willform.store');
    Route::get('will/submissions', [WillFormController::class, 'submissions'])->name('willform.submissions');
    Route::get('users', [UsersController::class, 'index'])->name('users.show');
    Route::get('form/single-will', [WillFormController::class, 'singleWillEdit'])->name('singleWill.form');
    Route::get('form/mirror-will', [WillFormController::class, 'mirrorWillEdit'])->name('mirrorWill.form');
    Route::post('form/update', [WillFormController::class, 'willFormUpdate'])->name('form.update');
});
