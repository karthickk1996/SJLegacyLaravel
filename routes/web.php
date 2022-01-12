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
});
